<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
    <header class="row">
        @include('includes.header')
    </header>
    {{--  {{dd($f['products'])}} --}}
    
    @php
    
    @endphp

   
   

    <div class="container mx-auto">
            <div id="js_formSect2">
            <h3 class="">PO Requisition {{$f['name']}}</h3>
           
            <div class="">
                <label for="deptName">Dept: 
                    <input class="input" type="text" name="deptName" readonly>
                </label>
            </div>
            <div class="">
                <label for="vendor">Vendor: 
                    <input class="input" type="text" name="vendor" value="{{$f['name']}}" readonly>
                    <input class="hidden" type="text" name="form_id" readonly>
                    <input class="hidden" type="text" name="dept_id" readonly>
                </label>
            </div>
      
       <div class="flex flex-row" id="js_productHeaders"> 
             <div class="basis-4/12 text-lg p-3 bg-blue-100" id="header_pn">
                <div class="w-full block">Part Number</div>
            </div>                     
             <div class="basis-8/12 text-lg p-3 bg-blue-100" id="header_desc">
                <div class="w-full block">Description</div>
            </div> 
        </div>
        <div id="js_products">
            @foreach($f['products'] as $k=>$v)
                <div class="flex flex-row">                        
                    <div class="basis-4/12 p-3 bg-gray-100">
                        {{$v['PN']}}
                    </div>
                    <div class="basis-8/12 p-3 bg-gray-100">
                       {{$v['DESC']}}
                    </div>
                </div>
            @endforeach 
        </div>
    
    </div>
    <footer class="row">
        @include('includes.footer')
    </footer>
</body>
</html>