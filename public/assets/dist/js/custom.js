/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";
function validateInput(form,ingoneInputName = []){
    var output = true;
    var validateInput = 0;
    var input = form.find('input');
    var textarea = form.find('textarea');
    var select = form.find('select');
    var allInput = [{el:input,text:'input'},{el:select,text:'select'},{el:textarea,text:'textarea'}];
    console.log(allInput);
    allInput.forEach(function(v,i){
        $.each(v.el, function (indexInArray,element) { 
            var name = element.name;
            //cek input ignore
            //jika input ada maka true, jika true maka skip in-valid
            var ignoreInput = checkInputIgnore(ingoneInputName,name);
       
            if(!ignoreInput){
                if(element.value == ""){
                    // array[indexInArray].addClass("is-invalid");
                    $(v.text+"[name='"+name+"']").addClass("is-invalid");
                    validateInput++;
                }else{
                    $(v.text+"[name='"+name+"']").removeClass("is-invalid");
                }
            }
        });
    })
    if(validateInput != 0){
        output = false;
    }
    return output;
}
function checkInputIgnore(inputName = [], name = ""){
    var result = false;
    inputName.forEach(function(item,index){
        if(item == name){
            result = true;
        }
    });
    return result;
}
function clearInput(formId){
    $(formId).find("input[type=text],input[type=password],input[type=email], textarea").val("");
}

function capitalize(word) {
    const lower = word.toLowerCase();
    return word.charAt(0).toUpperCase() + lower.slice(1);
}
function inArray(value, array) {
    for(var i = 0; i < array.length; i++) {
        if(array[i] == value) return true;
    }
    return false;
}
function inObject(value, arrayOject, key) {
    for(var i = 0; i < arrayOject.length; i++) {
        if(arrayOject[i][key] == value) return true;
    }
    return false;
}
function updateObject(arrayObject,key,value,key_update,newValue){
    //Find index of specific object using findIndex method.    
    var objIndex = arrayObject.findIndex((obj => obj[key] == value));

    //Log object to Console.
    console.log("Before update: ", arrayObject[objIndex])

    //Update object's name property.
    arrayObject[objIndex][key_update] = newValue;
}
function searchInObject(arrayObject,key,key_value){
    //Find index of specific object using findIndex method.    
    var objIndex = arrayObject.findIndex((obj => obj[key] == key_value));
    return arrayObject[objIndex];
}
function removeInObject(arrayObject,key,key_value){
    //Find index of specific object using findIndex method.    
    var objIndex = arrayObject.findIndex((obj => obj[key] == key_value));
    if(objIndex != -1){
        arrayObject.splice(objIndex,1);
        return true;
    }
    return false;
}
function compare(a, b ){
    if ( a.index < b.index ){
        return -1;
    }
    if ( a.index > b.index ){
        return 1;
    }
    return 0;
}
function setEditorText(elId){
    $(elId).summernote();
}