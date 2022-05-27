@if ($message = Session::get('success'))
<div class="bg-slate-800 bg-opacity-50 flex justify-center items-center absolute top-0 right-0 bottom-0 left-0 js_modal">
  <div class="bg-white px-16 py-14 rounded-md text-center">
    <h1 class="text-xl mb-4 font-bold text-slate-500">{{$message}}</h1>    
    <button class="bg-sky-500 px-7 py-2 ml-2 rounded-md text-md text-white font-semibold" onclick="closeModal(this)">Ok</button>
  </div>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    Check the following errors :(
</div>
@endif
<script type="text/javascript">
    //close the near ancestor w/ '.js_modal'
    //'evtNode' is clicked descendant.
    function closeModal(evtNode)
    {
        evtNode.closest('.js_modal').remove();
    }    
</script>