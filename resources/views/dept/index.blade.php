{{-- {{dd($depts)}} --}}
<!doctype html>
   
<html>
<head>
    @include('includes.head')
</head>
<body>
    <header class="row">
        @include('includes.header')
    </header>
    
    <div class="container mx-auto">           
            <h3 class="text-4xl font-normal leading-normal mt-0 mb-2 text-pink-800">Depts</h3>
           {{--  <div class="md:columns-2 md:gap-2">
                <div class="text-lg border-1 border-gray-300 p-6 bg-gray-100">
                    Filtered By Dept:                             
                </div>
                <div class="text-lg border-1 border-gray-300 p-6 bg-gray-100">
                    Filtered By User: 
                </div>
            </div> --}}
           <div class="md:columns-4 md:gap-2">                 
                <div class="border-1 border-blue-300 p-6 bg-blue-100">
                    Form
                </div>    
                 <div class="border-1 border-blue-300 p-6 bg-blue-100">
                    Created
                </div> 
                <div class="border-1 border-blue-300 p-6 bg-blue-100">
                    Updated
                </div> 
                <div class="border-1 border-blue-300 p-6 bg-blue-100">
                    Status
                </div>              
            </div>

        <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
        @foreach($depts as $d)
            <div class="md:columns-4 md:gap-2">
                <div class="border-1 border-gray-300 p-6 bg-gray-100">
                    {{$d['name']}}
                </div>
                <div class="border-1 border-gray-300 p-6 bg-gray-100">
                    {{$s['created_at']}}          
                </div>
                <div class="border-1 border-gray-300 p-6 bg-gray-100">
                     @if($s['updated_at'] === null)
                        Never
                     @else
                         {{$s['updated_at']}}
                     @endif
                    
                </div>
                <div class="border-1 border-gray-300 p-6 bg-gray-100">
                    @if($s['completed'] === 0)
                         <p>Pending [<a class="hyperlink" href="submission/{{$s['id']}}/edit" title="Make changes to this order before sending to the vendor.">Update</a>]</p>
                       @else
                       <p>Completed [<a class="hyperlink" href="submission/{{$s['id']}}/archive" title="Remove this old record from this listing.">Archive</a>]</p>
                     @endif 
                </div>
            </div>               
        @endforeach

        {{-- {{dd($submissions)}} --}}
    </div>
    

     <footer class="row">
        @include('includes.footer')
    </footer>

</body>

</html>