@props(['book'])
@if (is_null($book->front_matter))
        <x-scholar.alert proceed-text="upload now" href="{{route('scholar.book.pdf', ['book' => $book->id])}}">
            Please click "Upload Now" to upload one .PDF file that contains your BOOK TITLE PAGE, COPYRIGHT PAGE, ACKNOWLEDGMENT PAGE AND DEDICATION PAGE. Thank you!
        </x-scholar.alert>
@endif
