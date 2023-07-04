{{-- form to create and edit all the event content of the page --}}

@extends('admin.dashboard')
@section('content')
<form method="POST" action="{{$url}}" enctype="multipart/form-data">
    @csrf
    @if (isset($event))
        @method('PUT') 

@endif

    <div class="mb-6">
        <label for="title" class="inline-block text-lg mb-2">Title</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title" value="{{  $url === '/events' ? old('title') : $event->title}}"/>
        @error('title')
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="mb-6">
        <label for="image" class="inline-block text-lg mb-2">
            image
        </label>
        <input type="file" class="border border-gray-200 rounded p-2 w-full" name="image" id="imageInput" accept="image/*" onchange="{{  $url === '/events' ? "loadFile(event)" : "checkImageValue()"}}"/>
       
        {!! $url === '/events' ? "<img class='w-48 mr-6 mb-6' id='output'/>" : "<img class='w-48 mr-6 mb-6' id='previewImage' src='" . asset('storage/images/' . $event->image) . "' alt='' />" !!}


        @error('image')
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>
    <div class="mb-6">
        <label for="start_time" class="inline-block text-lg mb-2">Start Time</label>
        @if ($url !== '/events')
    @php $formattedStartTime = date('Y-m-d', strtotime($event->start_time)); @endphp
@endif
       
      
        <input type="date" class="border border-gray-200 rounded p-2 w-full" name="start_time" value="{{  $url === '/events' ? old('start_time') : $formattedStartTime }}"/>
        @error('start_time')
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>
    <div class="mb-6">
        <label for="end_time" class="inline-block text-lg mb-2">End Time</label>
        @if ($url !== '/events')
        @php $formattedEndTime = date('Y-m-d', strtotime($event->end_time));@endphp
    @endif
        
        <input type="date" class="border border-gray-200 rounded p-2 w-full" name="end_time" value="{{  $url === '/events' ? old('end_time') : $formattedEndTime}}"/>
        @error('end_time')
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>
  

    <div class="mb-6">
        <label for="body" class="inline-block text-lg mb-2">
            Description
        </label>
        <textarea class="border border-gray-200 rounded p-2 w-full" name="body" rows="10">{{  $url === '/events' ? old('title') : $event->body }}</textarea>
        @error('body')
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="mb-6">
        <button class="bg-black text-white rounded py-2 px-4">
            Post
        </button>
    </div>
</form>
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
          URL.revokeObjectURL(output.src) 
        }
      };
    
      function checkImageValue() {
      const imageInput = document.getElementById('imageInput');
      const previewImage = document.getElementById('previewImage');
    
      if (imageInput.files.length > 0) {
        const file = imageInput.files[0];
        const reader = new FileReader();
    
        reader.onload = function(event) {
          previewImage.src = event.target.result;
        };
    
        reader.readAsDataURL(file);
      } else {
      
      }
    }
    </script>
@endsection