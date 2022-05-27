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
        {{-- PATCH request --}}
            <form id="VendorForm" method="POST" action="{{route('form-update', ['fid'=>$form['id']])}}">
                @csrf
                @method('PATCH')
                
                <h2 class="text-4xl font-normal leading-normal mt-0 mb-2 text-pink-800">Vendor: "{{$form['name']}}"</h2> 
                <p class="inline-flex items-center py-2 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-pink-800" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    Use This Form to Update This Vendor's Product Listing.
                </p><br/>
                <p class="inline-flex items-center py-2 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-pink-800" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                    </svg>
                    Or create a &nbsp;<a class="hyperlink" href="/submission/create/{{$form['id']}}"> new P.O. Request<a/>&nbsp; for this vendor.
                    </p>
                {{-- <h4 class="text-2xl font-normal leading-normal mt-0 mb-2 text-pink-800">Assigned to Dept: "{{$form['dept']['name']}}"</h4>  --}}
                <div class="px-6 my-2">
                    {{-- hidden fields --}}                  
                    <input type="hidden" name="name" value="{{$form['name']}}" class="bg-violet-50" readonly>                       
                   {{--  <input type="hidden" name="id" value="{{$form['id']}}" readonly> --}}
                    <input type="hidden" name="dept_id" value="{{$form['dept_id']}}" readonly>
                    <label for="fax" class="block p-2 bg-sky-100 text-sky-800 my-2">Vendor's FAX #</label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" name="fax" value="{{$form['fax']}}">                
                    <label for="description" class="block p-2 bg-sky-100 text-sky-800 my-2">Form Description:</label>
                    <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="description" value="{{$form['description']}}">{{$form['description']}}</textarea>
                </div> 
                <div class="flex justify-between">
               <h4 class="text-2xl font-normal leading-normal mt-0 mb-2 text-pink-800 inline-block">Vendor's Item List</h4> 
               <button type="button" onclick="addNewItemRow()" class="bg-green-500 hover:bg-green-700 
                    text-white px-2 rounded mx-6 px-4 py-2 m-2 inline-block">+ New Item Row</button>
                </div>
               <div class="flex flex-row px-6 py-2 mt-2 text-sky-800" id="js_productHeaders">               
                     <div class="basis-4/12 text-lg py-3 px-4 bg-sky-100" id="header_pn">
                        <div class="w-full block">Part Number</div>
                    </div>                     
                     <div class="basis-5/12 text-lg py-3 px-4  bg-sky-100" id="header_desc">
                        <div class="w-full block">Description</div>
                    </div>
                    <div class="basis-3/12 text-lg py-3 px-4 bg-sky-100" id="header_qty">
                        <div class="w-full block">Action</div>
                    </div>   

                </div>
                <div id="js_products" class="">
                @foreach($form['products'] as $k=>$v)
                    <div class="flex flex-row text-base js_item-row px-6 py-2 mt-2">                    
                        <div class="basis-4/12 bg-gray-100">
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 sku" value="{{$v['PN']}}" name="{{$v['PN']}}[]" readonly />
                        </div>
                        <div class="basis-5/12 bg-gray-100 text-sm">
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 desc" value="{{$v['DESC']}}" name="{{$v['PN']}}[]"  readonly />
                        </div>
                        <div class="basis-3/12 bg-gray-100 js_btn-wrapper"> 
                            <div class="columns-2 px-2 py-1 js_default-btns">
                                    <button class="bg-sky-500 hover:bg-sky-700 text-white px-2 rounded mx-6" type="button" onclick="editItem(this)">Edit</button>                                
                                    <button class="bg-red-500 hover:bg-red-700 text-white px-2 rounded" type="button" onclick="deleteItem(this)">Delete</button>
                            </div>
                            <div class="columns-2 px-2 py-1 js_alternate-btns hidden">
                                    <button class="bg-green-500 hover:bg-green-700 text-white px-2 rounded mx-6 " type="button" onclick="acceptChanges(this)">OK</button>                                
                                    <button class="bg-red-500 hover:bg-red-700 text-white px-2 rounded" type="button" onclick="rejectChanges(this)">Cancel</button>
                            </div>
                        </div>
                    </div>             
                @endforeach                 
            </div> 
            <div class="flex justify-center">
                <div class="align-center px-2 py-1">                    
                    <button type="submit" class="bg-sky-500 hover:bg-sky-700 text-white px-2 rounded mx-6 
                    px-4 py-3 m-6">SAVE MY CHANGES</button>
                </div>     
            </div>      
       </form>
</div>
   
        
     <footer class="row">
        @include('includes.footer')
    </footer>
    
    <script src="<?php echo URL::asset('js/form-edit.js') ?>"></script>


</body>

</html>