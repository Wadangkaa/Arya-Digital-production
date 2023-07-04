@extends('admin.dashboard')
@section('content')
      <table class="w-full table-auto rounded-sm">
            <tbody>
                
                   <table class="w-full table-auto rounded-sm">
        <tbody>
            <tr class="border-gray-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <h1 class="text-3xl text-center font-bold my-6 uppercase">
                        Your services
                    </h1>
                </td>
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <a href="/service/create"  class="bg-black text-white py-2 px-5">Add service</a>
                </td>
                
            </tr>
        </tbody>
    </table>
                    
        
    </header>

    <table class="w-full table-auto rounded-sm">
        <tbody>
            @unless ($services->isEmpty())
            @foreach($services as $service)
            
            <tr class="border-gray-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <a href="/services/{{$service->id}}" >
                        {{$service->title}}
                    </a>
                </td>
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    
                    <img class='w-24 mr-2 mb-2' src="{{ asset('storage/images/' . $service->image) }}" alt='' />

                   
                </td>
                
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <a href="/service/{{$service->id}}/edit" class="text-blue-400 px-6 py-2 rounded-xl"><i
                            class="fa-solid fa-pen-to-square"></i>
                        Edit</a>
                </td>
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <form action="/service/{{$service->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500"> <i class="fa-solid fa-trash"></i>DELETE</button>
                    
                    </form>
                </td>
            </tr>
            @endforeach
            @else 
            <tr class="border-gray-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <p class="text-center">
                        No services Found!
                    </p>
                </td>
            </tr>
            @endunless


        </tbody>
    </table>
</body>

</html>   

@endsection
