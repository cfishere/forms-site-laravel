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
            <form id="poSubmission" method="POST" action="/submission/save">
                @csrf               
                
                <h2 class="text-4xl font-normal leading-normal mt-0 mb-2 text-pink-800">New PO Requisition: "{{$form['name']}}"</h2> 
                {{-- <h4 class="text-2xl font-normal leading-normal mt-0 mb-2 text-pink-800">Requesting Dept: "{{$form['dept']['name']}}"</h4>  --}}
                <div class="px-6 my-2">
                    {{-- hidden fields --}}                  
                    <input type="hidden" name="name" value="{{$form['name']}}" class="bg-violet-50" readonly>                       
                   <input type="hidden" name="form_id" value="{{$form['id']}}" readonly>                  
                    <input type="hidden" name="dept_id" value="{{$form['dept_id']}}" readonly>
                    <input type="hidden" name="dept_name" value="{{$form['dept']['name']}}" readonly>
                    <input type="hidden" name="vendor" value="{{$form['name']}}" readonly>
                    <label for="fax" class="block p-2 bg-sky-100 text-sky-800 my-2">Vendor's FAX #</label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" name="fax" value="{{$form['fax']}}" readonly>                
                    <label for="description" class="block p-2 bg-sky-100 text-sky-800 my-2">Form Description:</label>
                    <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 focus:outline-none" name="description" value="{{$form['description']}}" readonly>{{$form['description']}}</textarea>
                </div> 
                
               <h4 class="text-2xl font-normal leading-normal mt-0 mb-2 text-pink-800 inline-block">Items</h4> 
             
               <div class="flex flex-row px-6 py-2 mt-2 text-sky-800" id="js_productHeaders">               
                     <div class="basis-1/12 text-lg py-3 px-4 bg-sky-100 block w-full" id="header_pn">
                        <div class="w-full block">Qty</div>
                    </div>                     
                     <div class="basis-4/12 text-lg py-3 px-4 block w-full bg-sky-100" id="header_desc">
                        <div class="w-full block">Part Number</div>
                    </div>
                    <div class="basis-7/12 text-lg py-3 px-4 block w-full bg-sky-100" id="header_qty">
                        <div class="w-full block">Description</div>
                    </div>
                </div>
                <div id="js_products" class="">
                @foreach($form['products'] as $k=>$v)
                    <div class="flex flex-row px-6 py-2 mt-2">                        
                        <input class="basis-1/12 border-purple-200 border-2 bg-white appearance-none block w-full text-violet-700 p-2 leading-tight focus:outline-none focus:bg-purple-50  qty" type="number" value="" name="{{$v['PN']}}['QTY']"/>                    
                        <input class="basis-4/12 bg-gray-100 appearance-none block w-full text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 sku" value="{{$v['PN']}}" name="{{$v['PN']}}['PN']" readonly />
                        <input class="basis-7/12 bg-gray-100 appearance-none block w-full text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 desc" value="{{$v['DESC']}}" name="{{$v['PN']}}['DESC']" readonly />
                    </div>                           
                @endforeach                 
            </div> 
            <div class="flex justify-center">
                <div class="align-center px-2 py-1">                    
                    <button type="submit" class="bg-sky-500 hover:bg-sky-700 text-white px-2 rounded mx-6 
                    px-4 py-3 m-6">SUBMIT</button>
                </div>     
            </div>      
       </form>
</div>
   
        
     <footer class="row">
        @include('includes.footer')
    </footer>
    
    <script src="<?php echo URL::asset('new.submission.js') ?>"></script>


</body>

</html>