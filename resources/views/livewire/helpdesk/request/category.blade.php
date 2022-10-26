<div class="flex flex-col justify-center items-start space-y-2 w-full h-full">
    <span class="font-semibold">{{ $row->category }}</span>
    <span>Subkategori: {{ \App\Models\Request::whereId($row->id)->first()->subcategory }}</span>
</div>
