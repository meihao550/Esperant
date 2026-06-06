<x-web-layout>
    <h1>参考文献生成</h1>
    <p>ここは参考文献生成のページです。</p>
    <h2>スタイルの選定</h2>
    <p>参考文献のスタイルを選択してください。</p>
    <select name="style" id="style" class="border border-gray-300 rounded px-4 py-2">
        <option value="apa">APA</option>
        <option value="mla">MLA</option>
        <option value="chicago">Chicago</option>
    </select>
    <h2>参考文献の入力</h2>
    <p>参考文献の情報を入力してください。</p>
    <form action="/generate" method="POST" class="mt-4">
        @csrf
        <div class="mb-4">
            <label for="author" class="block text-gray-700">著者:</label>
            <input type="text" name="author" id="author" class="w-full  border border-gray-300 rounded px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="title" class="block text-gray-700">タイトル:</label>
            <input type="text" name="title" id="title" class="w-full  border border-gray-300 rounded px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="year" class="block text-gray-700">出版年:</label>
            <input type="text" name="year" id="year" class="w-full  border border-gray-300 rounded px-4 py-2" required>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">生成</button>
    </form>
</x-web-layout>