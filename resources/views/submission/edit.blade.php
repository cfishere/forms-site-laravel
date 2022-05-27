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
            <form id="VendorForm" action="/submission/{{$submission['id']}}/update" method="POST">
                @csrf
                @method('PATCH')

                <div id="js_formSect2">
                    <h3 class="text-4xl font-normal leading-normal mt-0 mb-2 text-pink-800">Update Requisition #{{$submission['id']}}</h3>
                    {{-- <p class="py-5">If you instead want to create a new requisition start <a href="route('submission.create')"
                        class="hyperlink">here</a></p> --}}
                    <div class="columns">
                        <div class="control column is-half is-mobile">
                            <label for="deptName">Dept: 
                                <input class="input" type="text" name="dept_name" value="{{$submission['dept_name']}}" readonly>
                            </label>
                            <input type="hidden" name="dept_id" value="{{$submission['dept_id']}}"/>
                        </div>
                        <div class="control column is-half is-mobile">
                            <label for="vendor">Vendor: 
                                <input class="input" type="text" name="vendor" readonly  value="{{$submission['vendor']}}">
                                <input type="hidden" name="form_id" value="{{$submission['form_id']}}"/>
                            </label>
                        </div>
                    </div>
                    {{-- <h1 class="title is-size-3 has-text-blue">
                        {{$submission['vendor']}}
                    </h1>   --}}
                    <div class="flex flex-row px-6 py-2 mt-2 text-sky-800" id="js_productHeaders">                    
                        <!--
                        <div class="column is-7 is-two-fifths has-text-weight-bold is-info" id="header_desc">
                            Description
                        </div>
                        -->
                        <div class="basis-2/12 text-lg py-3 px-4 bg-sky-100 block w-full" id="qty">
                            Qty
                        </div>    
                         <div class="basis-4/12 text-lg py-3 px-4 bg-sky-100 block w-full" id="sku">
                            Part #
                        </div>
                        <div class="basis-6/12 text-lg py-3 px-4 bg-sky-100 block w-full" id="desc">
                            Desc
                        </div>             
                    </div>
                    <div id="js_products">
                        @foreach($submission['data'] as $partnumber => $row)
                           
                            <div class="flex flex-row text-base js_item-row px-6 py-2 mt-2">
                                <div class="basis-2/12 bg-gray-100">
                                    <input class="appearance-none block w-full bg-violet-50 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 qty" type="number" value="{{$row['QTY']}}" name="{{$partnumber}}[QTY]"/>
                                </div>
                                <div class="basis-4/12 bg-gray-100">
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight pn" value="{{$row['PN']}}" name="{{$partnumber}}[PN]" readonly/>
                                </div>   
                                <div class="basis-6/12 bg-gray-100">
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight desc" value="{{$row['DESC']}}" name="{{$partnumber}}[DESC]" readonly/>
                                </div>                     
                            </div>
                           
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-center">
                <div class="align-center px-2 py-1">                    
                    <button type="submit" class="bg-sky-500 hover:bg-sky-700 text-white px-2 rounded mx-6 
                    px-4 py-3 m-6">Submit Changes</button>
                </div>     
            </div>      
            </form>
        </div>    
    <footer class="row">
        @include('includes.footer')
    </footer>

</body>

</html>