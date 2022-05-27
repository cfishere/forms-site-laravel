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
            <form id="VendorForm" method="POST" action="/form/save">
                @csrf             
                
                <h2 class="text-4xl font-normal leading-normal mt-0 mb-2 text-pink-800">Create a New Vendor Form</h2> 
                <h4 class="text-2xl font-normal leading-normal mt-0 mb-2 text-pink-800">Assign Department(s) That Will Use This Form</h4> 
                <div class="px-6 my-2"> 

                    <label for="name" class="block p-2 bg-sky-100 text-sky-800 my-2">Vendor Company Name</label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" name="name" value="">             

                    <label for="fax" class="block p-2 bg-sky-100 text-sky-800 my-2">Vendor's FAX #</label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" name="fax" value="" placeholder="000-000-0000">
                    
                    <label for="description" class="block p-2 bg-sky-100 text-sky-800 my-2">Vendor Description:</label>
                    <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="description" value=""></textarea>
                    
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
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 sku" value="" name="PN[]" />
                        </div>
                        <div class="basis-5/12 bg-gray-100 text-sm">
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 desc" value="" name="DESC[]" />
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
    {{-- html stub to clone for new product item rows to be appended into the form --}}
    <div class="flex flex-row text-base js_item-row hidden" id="js_item-row-template">                    
        {{-- <div class="basis-4/12 bg-gray-100">
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 sku" value="" name="PN[]" placeholder="USE ALL CAPS FOR PART NUMBER" />
        </div>
        <div class="basis-5/12 bg-gray-100 text-sm">
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 desc" value="" name="DESC[]" placeholder="USE ALL CAPS FOR DESCRIPTION" />
        </div> --}}
        <div class="basis-3/12 bg-gray-100 js_btn-wrapper"> 
            <div class="columns-2 px-2 py-1 js_default-btns">
                    <button class="bg-sky-500 hover:bg-sky-700 text-white px-2 rounded mx-6" type="button" onclick="editItem(this)">Edit</button>                                
                    <button class="bg-red-500 hover:bg-red-700 text-white px-2 rounded" type="button" onclick="deleteItem(this)">Delete</button>
            </div>
            <div class="columns-2 px-2 py-1 js_alternate-btns hidden">
                    <button class="bg-green-500 hover:bg-green-700 text-white px-2 rounded mx-6" type="button" onclick="acceptChanges(this)">OK</button>                                
                    <button class="bg-red-500 hover:bg-red-700 text-white px-2 rounded" type="button" onclick="rejectChanges(this)">Cancel</button>
            </div>
        </div>
    </div>             
    <script src="<?php echo URL::asset('js/form-edit.js') ?>"></script>


</body>

</html>