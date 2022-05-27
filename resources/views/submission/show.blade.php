<!doctype html>
   {{-- {{dd($submission)}} --}}
<html>
<head>
    @include('includes.head')
</head>
<body>
<header class="row">
    @include('includes.header')
</header>    
<div class="container mx-auto">   
	{{-- View to show a PO Request.  Allow to download or email it. --}}	
    {{-- Email Form: --}}
    <form method="post" action="{{$submission['id']}}">
	   @csrf
        <div class="columns-3">
            <div class="control">
                <label for="email">SEND TO:</label><br>
                <input class="w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="email" name="email" required />
            </div>
            <div class="control">
                <label for="sendername">SENDER (Your Name):</label>
                <input class="w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="email" name="sendername" value="{{Auth::user()->name}}" />
            </div>
            <div class="control">
                <label for="subj">SUBJ:</label>
                <input class="w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" name="subj" value="PO Requistion for {{$submission['vendor']}}, PDF Attached."/>
            </div>
        </div>
        <label for="body">EMAIL MESSAGE:</label><br>
        <textarea class="form-textarea w-full bg-gray-200 text-gray-700 p-2" name="body">Please See The Attached PDF File for PO Requestion No. {{$submission['id']}}, Vendor {{$submission['vendor']}}</textarea> 

        <input type="hidden" name="submission_id" value="{{$submission['id']}}"/>
        <input type="hidden" name="vendor" value="{{$submission['vendor']}}"/>


        <div class="flex justify-center">
            <div class="align-center px-2 py-1">                    
                <button type="submit" class="bg-sky-500 hover:bg-sky-700 text-white px-2 rounded mx-6 
                px-4 py-3 m-6">SEND THE PDF FILE</button>      
            </div>     
        </div>                        
    </form>
    
    <h3 class="text-4xl font-normal leading-normal mt-0 mb-2 text-pink-800">Requisition No. {{$submission['id']}}</h3>
    <p class="py-5">DOWNLOAD TO A PDF <a href="{{url('/submission/pdf/'.$submission['id'])}}"
        class="hyperlink">HERE</a></p>
    <div class="columns">
        <div class="control column is-half is-mobile">
                <div>
                    Dept: {{$submission['dept_name']}}
                </div>
        </div>
        <div class="control column is-half is-mobile">             
                <div type="text" name="vendor">
                    Vendor: {{$submission['vendor']}} (Id No. {{$submission['id']}})
                </div>   
        </div>
    </div>       
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
    <div id="js_products">'
        @foreach($submission['data'] as $partnumber => $row)
           
            <div class="flex flex-row text-base js_item-row px-6 py-2 mt-2">
                <div class="basis-2/12 bg-gray-100">
                    <div class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number">
                        {{$row['QTY']}}
                    </div>
                </div>
                <div class="basis-4/12 bg-gray-100">
                    <div class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight">
                        {{$row['PN']}}
                    </div>
                </div>   
                <div class="basis-6/12 bg-gray-100">
                    <div class="appearance-none block w-full bg-gray-200 text-gray-700 p-2 leading-tight">
                        {{$row['DESC']}}
                    </div>                     
                </div>
            </div>
          
        @endforeach
    </div>
    <footer class="row">
        @include('includes.footer')
    </footer>
</div>