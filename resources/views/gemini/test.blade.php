<x-web-layout>

<style>
    .highlight {
        background: #fef08a;
        border-bottom: 2px solid #eab308;
        cursor: pointer;
        border-radius: 2px;
        transition: background 0.2s;
        position: static;
    }
    .highlight:hover { background: #fde047; }
    .highlight.fixed {
        background: #bbf7d0;
        border-bottom: 2px solid #22c55e;
        cursor: default;
        position: static;
    }
    @keyframes wave {
        0%, 100% { transform: scaleY(0.3); }
        50%       { transform: scaleY(1); }
    }
    .bar {
        width: 4px;
        border-radius: 2px;
        background: #3b82f6;
        transform-origin: bottom;
        animation: wave 1s ease-in-out infinite;
    }
    .suggestion-card.active {
        border-color: #eab308;
        background: #fefce8;
    }
</style>

<div class="max-w-5xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">レポート文体チェッカー</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
            @foreach($errors->all() as $e)
                <p>{{ $e }}</p>
            @endforeach
        </div>
    @endif

    {{-- フォーム --}}
    @if(!isset($original))
    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <form method="POST" action="{{ route('gemini-review') }}" id="reviewForm">
            @csrf
            <label class="block font-semibold mb-2">レポート本文（50文字以上）</label>
            <textarea name="report" id="reportText" rows="12"
                class="w-full border rounded-lg p-3 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="チェックしたいレポートをここに貼り付けてください..."></textarea>

            <div class="flex items-center gap-3 mt-2 mb-4">
                <span class="text-sm text-gray-500">文字数：</span>
                <span id="charCount" class="font-bold text-blue-600">0</span>
                <span class="text-sm text-gray-500">文字</span>
                <div class="flex-1 bg-gray-200 rounded-full h-2">
                    <div id="progressBar" class="h-2 rounded-full transition-all bg-red-400" style="width:0%"></div>
                </div>
                <span id="statusLabel" class="text-xs font-semibold text-red-500">不足</span>
            </div>

            <button type="submit" id="submitBtn"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed"
                disabled>
                Geminiに文体チェックしてもらう
            </button>

            <div id="loadingArea" style="display:none;" class="flex items-center gap-2 mt-4 justify-center">
                <div class="bar" style="height:30px; animation-delay:0.0s;"></div>
                <div class="bar" style="height:20px; animation-delay:0.1s;"></div>
                <div class="bar" style="height:30px; animation-delay:0.2s;"></div>
                <div class="bar" style="height:15px; animation-delay:0.3s;"></div>
                <div class="bar" style="height:30px; animation-delay:0.4s;"></div>
                <div class="bar" style="height:25px; animation-delay:0.5s;"></div>
                <div class="bar" style="height:30px; animation-delay:0.6s;"></div>
                <span class="text-sm text-gray-500 ml-2">Geminiが分析しています...</span>
            </div>
        </form>
    </div>
    @endif

    {{-- 結果エリア --}}
    @isset($original)
    <div class="flex gap-4">

        {{-- 左：本文 --}}
        <div class="flex-1 bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between mb-3">
                <h2 class="font-bold text-lg">本文</h2>
                <span class="text-sm text-gray-500">
                    指摘：<span id="remainCount">{{ count($suggestions) }}</span>件
                </span>
            </div>
            <div id="reportBody"
                 contenteditable="true"
                 class="text-sm leading-8 whitespace-pre-wrap font-mono border rounded-lg p-4 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400"
                 data-original="{{ $original }}"
                 data-suggestions="{{ json_encode($suggestions, JSON_UNESCAPED_UNICODE) }}">
            </div>
            <a href="/gemini-test" class="block text-center mt-4 text-blue-500 hover:underline text-sm">
                ← 別のレポートをチェックする
            </a>
        </div>

        {{-- 右：指摘カード --}}
        <div class="w-72 flex flex-col gap-3" id="suggestionPanel">
            @forelse($suggestions as $i => $item)
            <div class="suggestion-card bg-white border rounded-xl shadow p-4 transition" id="card-{{ $i }}">
                <span class="text-xs font-semibold px-2 py-0.5 rounded-full
                    {{ $item['type'] === '混在'  ? 'bg-yellow-100 text-yellow-700' : '' }}
                    {{ $item['type'] === '句読点' ? 'bg-blue-100 text-blue-700'    : '' }}
                    {{ $item['type'] === '接続詞' ? 'bg-purple-100 text-purple-700': '' }}
                    {{ $item['type'] === 'ねじれ' ? 'bg-red-100 text-red-700'      : '' }}
                ">{{ $item['type'] }}</span>
                <p class="text-xs text-gray-500 mt-2">{{ $item['reason'] }}</p>
                <div class="mt-2 text-sm">
                    <span class="line-through text-red-400">{{ $item['original'] }}</span>
                    <span class="text-gray-400 mx-1">→</span>
                    <span class="text-green-600 font-semibold">{{ $item['suggestion'] }}</span>
                </div>
                <div class="flex gap-2 mt-3" id="buttons-{{ $i }}">
                    <button onclick="fixItem({{ $i }})"
                        class="flex-1 bg-green-500 hover:bg-green-600 text-white text-xs font-bold py-1.5 rounded">
                        ✅ Fix
                    </button>
                    <button onclick="skipItem({{ $i }})"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-600 text-xs font-bold py-1.5 rounded">
                        Skip
                    </button>
                </div>
            </div>
            @empty
            <div class="bg-green-50 border border-green-300 rounded-xl p-4 text-green-700 text-sm font-semibold">
                ✅ 指摘箇所はありませんでした！
            </div>
            @endforelse
        </div>

    </div>
    @endisset

</div>

<script>
const textarea = document.getElementById('reportText');
if (textarea) {
    textarea.addEventListener('input', function () {
        const len = this.value.length;
        document.getElementById('charCount').textContent = len;
        const pct = Math.min((len / 2000) * 100, 100);
        document.getElementById('progressBar').style.width = pct + '%';
        const ok = len >= 50;
        document.getElementById('progressBar').className = 'h-2 rounded-full transition-all ' + (ok ? 'bg-green-400' : 'bg-red-400');
        document.getElementById('statusLabel').textContent = ok ? 'OK' : '不足';
        document.getElementById('statusLabel').className = 'text-xs font-semibold ' + (ok ? 'text-green-600' : 'text-red-500');
        document.getElementById('submitBtn').disabled = !ok;
    });
    document.getElementById('reviewForm').addEventListener('submit', function () {
        document.getElementById('loadingArea').style.display = 'flex';
        document.getElementById('submitBtn').disabled = true;
    });
}

const reportBody = document.getElementById('reportBody');
if (reportBody) {
    const original    = reportBody.dataset.original;
    const suggestions = JSON.parse(reportBody.dataset.suggestions);
    const state       = suggestions.map(() => ({ fixed: false, skipped: false }));

    function escapeHtml(str) {
        return str
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    }

    function render() {
        let parts = [{ text: original, type: 'raw' }];

        suggestions.forEach((item, i) => {
            if (state[i].skipped) return;

            const newParts = [];
            parts.forEach(part => {
                if (part.type !== 'raw') { newParts.push(part); return; }

                const idx = part.text.indexOf(item.original);
                if (idx === -1) { newParts.push(part); return; }

                newParts.push({ text: part.text.slice(0, idx), type: 'raw' });
                newParts.push({ text: item.original, type: 'highlight', index: i });
                newParts.push({ text: part.text.slice(idx + item.original.length), type: 'raw' });
            });
            parts = newParts;
        });

        reportBody.innerHTML = parts.map(p => {
            if (p.type === 'raw') return escapeHtml(p.text);
            const i           = p.index;
            const cls         = state[i].fixed ? 'highlight fixed' : 'highlight';
            const displayText = state[i].fixed ? suggestions[i].suggestion : suggestions[i].original;
            return `<span class="${cls}" style="position:static;" onclick="scrollToCard(${i})" id="hl-${i}">${escapeHtml(displayText)}</span>`;
        }).join('');
    }

    render();

    window.fixItem = function (i) {
        state[i].fixed = true;
        document.getElementById('buttons-' + i).innerHTML =
            '<span class="text-green-600 text-xs font-semibold">✅ 修正済み</span>';
        document.getElementById('card-' + i).classList.add('opacity-50');
        render();
        updateRemainCount();
    };

    window.skipItem = function (i) {
        state[i].skipped = true;
        const hl = document.getElementById('hl-' + i);
        if (hl) {
            const text = document.createTextNode(suggestions[i].original);
            hl.replaceWith(text);
        }
        document.getElementById('buttons-' + i).innerHTML =
            '<span class="text-gray-400 text-xs font-semibold">スキップ済み</span>';
        document.getElementById('card-' + i).classList.add('opacity-50');
        updateRemainCount();
    };

    window.scrollToCard = function (i) {
        const card = document.getElementById('card-' + i);
        if (!card) return;
        card.scrollIntoView({ behavior: 'smooth', block: 'center' });
        card.classList.add('active');
        setTimeout(() => card.classList.remove('active'), 1500);
    };

    function updateRemainCount() {
        const remain = state.filter(s => !s.fixed && !s.skipped).length;
        const el = document.getElementById('remainCount');
        if (el) el.textContent = remain;
    }
}
</script>

</x-web-layout>