<html>
<head>
    @include('includes.head')
</head>
<body>
    <header class="row">
        @include('includes.header')
    </header>
    
    <div class="container mx-auto">
         <h3 class="text-4xl font-normal leading-normal mt-0 mb-2 text-pink-800">{{$data['page-title']}}</h3>
         <p>
            {{$data['error']}}
         </p>
    </div>    
    <footer class="row">
        @include('includes.footer')
    </footer>

</body>

</html>
