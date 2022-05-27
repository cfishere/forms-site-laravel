<!doctype html>
    {{-- view for routes: forms, forms/{dept_id}.--}}
     {{-- {{dd($forms)}}  --}}
<html>
<head>
    @include('includes.head')
</head>
<body>
    <header class="row">
        @include('includes.header')
    </header>
    
    <div class="container mx-auto"> 
        <h2 class="text-4xl font-normal leading-normal mt-0 mb-2 text-pink-800">PO Requisition Forms</h2>         
           <div class="md:columns-5 md:gap-2">                 
                <div class="p-6 bg-blue-100">
                    Vendor
                </div>    
                 <div class="p-6 bg-blue-100">
                    Dept
                </div> 
                <div class="p-6 bg-blue-100">
                    #Items
                </div> 
                <div class="p-6 bg-blue-100">
                    #Submissions
                </div> 
                <div class="p-6 bg-blue-100">
                    Last Update
                </div>              
            </div>

        <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
        @foreach($forms as $f)
            <div class="md:columns-5 md:gap-2">
                <div class="p-6 bg-gray-100">
                    <!-- show form, from which you can submit new, or edit if having permissions -->
                    <a href="{{route('form-edit', ['form'=>$f['id']])}}" title="View/Edit Vendor Requisition Form"
                    class="hyperlink"> {{$f['name']}}</a>
                </div>
                <div class="p-6 bg-gray-100">
                     {{$f->dept->name}}
                </div>
                <div class="p-6 bg-gray-100">
                    {{count($f->products)}}
                </div>
                <div class="p-6 bg-gray-100">                   
                        {{count($f->submission)}}
                </div>
                <div class="p-6 bg-gray-100">
                    @if($f['updated_at'] === null)
                        Never
                     @else
                         {{$f['updated_at']}}
                     @endif
                </div>
            </div>               
        @endforeach
       {{-- for pagination linking :  {{ $forms->links() }} --}}
    </div>
        <footer class="row">
        @include('includes.footer')
    </footer>

</body>

</html>
