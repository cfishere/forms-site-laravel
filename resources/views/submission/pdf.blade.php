<!doctype html>
   
<html>
<head>
    @include('includes.head')
</head>
<body>
 
    @include('includes.pdfheader')
    <h3 class="text-4xl font-normal leading-normal mt-0 mb-2 text-pink-800">Requisition No. {{$submission['id']}}</h3>
    <table class="container mx-auto">        
        <tr>
            <th class="control column is-half is-mobile">
               <th>                
                Dept: {{$submission['dept_name']}}                
            </th>
            <th>                
                Vendor: {{$submission['vendor']}}                
            </th>
        </tr>
        </table>      
        <table>
        <tr>
            <th>
                Qty
            </th>    
             <th>
                Part #
            </th>
            <th>
                Desc
            </th>             
        </tr>
       
            @foreach($submission['data'] as $partnumber => $row)
               
                <tr class="p-2">
                    <td class="px-2">
                        {{$row['QTY']}}
                    </td>
                    <td class="px-2">
                       {{$row['PN']}}
                    </td>
                    <td class="px-2">
                       {{$row['DESC']}}
                    </td>                   
                </tr>
            @endforeach
        </table>

</body>

</html>