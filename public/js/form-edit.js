let formModified = false;
let backedUpItemRecord = {"sku":"", "desc":""};
let currentRowWrapperClass = ".js_item-row"; //when adding new row, class changes to js_user-added-item
function callOut(msg)
{
	alert(msg);
}

/*vendor product line item del btn clicked*/
function deleteItem(btn){
	currentRowWrapperClass = getParentWrapClassFor(btn);
	let msg = "You are about to permanently remove this product item from this Vendor's List.  Proceed?";
	let itemName='';
	if(confirm(msg) === true){
		let row = btn.closest(currentRowWrapperClass);
		itemName = row.getElementsByClassName('sku')[0].value;
		//TODO: capture the sku and desc in the var backedUpItemRecord to for user reverting his changes.
		btn.closest(currentRowWrapperClass).remove();
		formModified = true;	
	} else {
		return;
	}
	callOut('After Item '+itemName+' Is Removed, Save The Form to Make this Update Permanent.');	
}

/*vendor product line item edit btn clicked*/
function editItem(btn)
{
	currentRowWrapperClass = getParentWrapClassFor(btn);	
	let rowElements = getElements(btn, currentRowWrapperClass);
	rowElements['inputs'].forEach(function($input){
		if($input.hasAttribute('readonly')){		
			$input.removeAttribute('readonly');
		}
		//Record the original input values in case user makes edits, but then clicks cancel button.
		//but only if this isn't a new item added to the form:
		if(currentRowWrapperClass !== ".js_user-added-item")
		{
			if($input.classList.contains('sku'))
			{
				backedUpItemRecord.sku = $input.value;
			}
			if($input.classList.contains('desc'))
			{
				backedUpItemRecord.desc = $input.value;
			}
		}
		setStyle('editMode', $input);
	});
	//update the user buttons for this line item to OK/cancel.
	rowElements.parentAltBtns.classList.remove('hidden');
	rowElements.parentDefaultBtns.classList.add('hidden');	
}

function getElements(btn, currentRowWrapperClass)
{
	const row = btn.closest(currentRowWrapperClass);
	const btnWrapper = row.querySelector(".js_btn-wrapper");
	let alternateBtnset = btnWrapper.querySelector(".js_alternate-btns");
	let defaultBtnset = btnWrapper.querySelector(".js_default-btns");
	let rowInputs = row.querySelectorAll('input');
	return {
		"parentAltBtns":alternateBtnset,
		"parentDefaultBtns":defaultBtnset,
		"inputs":rowInputs,
		"rowContainer":row
		};
}

function acceptChanges(btn)
{
	formModified = true;
	//TODO: clone the item row var recentlyClonedItemRow so user may undo this change.
	let rowElements = getElements(btn, currentRowWrapperClass);
	rowElements['inputs'].forEach(
		function($input)
		{				
			$input.setAttribute('readonly', true);
			$input.value = $input.value.toUpperCase();
			setStyle('defaultMode', $input);
		}
	);
	//update the user buttons for this line item to OK/cancel.
	rowElements.parentAltBtns.classList.add('hidden');
	rowElements.parentDefaultBtns.classList.remove('hidden');
}

function rejectChanges(btn)
{
	formModified = false;
	let rowElements = getElements(btn, currentRowWrapperClass);
	//if this is a new row item added by user, just delete the row, don't revert
	//to the old sku and desc input values.
	if(rowElements['rowContainer'].classList.contains('js_user-added-item')){
		rowElements['rowContainer'].remove();
		return;
	}
	rowElements['inputs'].forEach(function($input){	
		setStyle('defaultMode', $input);			
		$input.setAttribute('readonly', true);
		if(currentRowWrapperClass !== ".js_user-added-item")
		{
			if($input.classList.contains('sku'))
			{
				 $input.value = backedUpItemRecord.sku;
			}
			if($input.classList.contains('desc'))
			{
				$input.value = backedUpItemRecord.desc;
			}
		}
		
	});
	//update the user buttons for this line item to OK/cancel.
	rowElements.parentAltBtns.classList.add('hidden');
	rowElements.parentDefaultBtns.classList.remove('hidden');	
}

function addNewItemRow()
{
	//clone the first item row
	let template = document.querySelector(".js_item-row").cloneNode(true);

	//add on an identifier so we know this is an add-on item.  Why?  When clicking
	//'cancel' button, the script replaces the part no. and desc input values with an
	//old value that is found for 'undo' operations when cancelling an existing item row.
	
	
	template.classList.add('js_user-added-item');
	template.classList.remove('js_item-row');
	currentRowWrapperClass=".js_user-added-item";
	//remove name and value attributes from the clone's subtree input elements.
	let inputs = template.querySelectorAll('input');
	inputs.forEach(function($input, i){
		
		$input.value="";		
		$input.removeAttribute('readonly');
		//change input bg color to alert user it is in edit mode:
		
		if(i===0){
			$input.setAttribute('placeholder','TYPE NEW ITEM PART NO. USING ALL CAPS.');
			$input.setAttribute('name', 'PN[]');
		}else{
			$input.setAttribute('placeholder','TYPE NEW DESC USING ALL CAPS.');
			$input.setAttribute('name', 'DESC[]');
		}
		//change the buttons, 
		template.querySelector('.js_default-btns').classList.add('hidden');
		template.querySelector('.js_alternate-btns').classList.remove('hidden');
		setStyle('editMode', $input);
	});
	
	document.getElementById('js_products').appendChild(template);
}

function setStyle(mode, el){
	switch(mode){
		case 'editMode':
			el.classList.remove('bg-gray-200')
			el.classList.add('bg-violet-50');
			break;		
		case 'defaultMode':
			el.classList.remove('bg-violet-50')
			el.classList.add('bg-gray-200');
			break;
	}
}

function getParentWrapClassFor(btn)
{
	if(btn.closest(".js_user-added-item"))
	{
		return ".js_user-added-item";
	} else {
		return ".js_item-row";
	}
}


/**
 * [toggleHideShow description]
 * @param  obj hideAndShowNodeList two properties "hide": Array of Nodes and "show": Array of Nodes
 * @return {[type]}                     [description]
 */
function toggleHideShow(hideAndShowNodeList){

}