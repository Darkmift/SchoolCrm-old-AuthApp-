 //graveeyard chunk 1
 UpdName = $('<input>', {
     type: "text",
     name: "name",
     value: String(data.name)
 });
 console.log(UpdName);
 $('#detailsDisplay').html([
     createInput("name", String(data.name), 'text'),
     createInput("phone", String(data.phone), 'number')
 ]);
 $('#UpDelBtns').html(
     $('<button>', {
         id: data.id,
         name: type,
         value: "update",
         class: "btn btn-warning",
         text: "Submit",
     })
 );

 //graveeyard chunk 2
 //experimental input group maker.currently not in use
 function createInput(namestr, inputValue, inputType) {
     containerInput = $('<div>', {
         class: "input-group",
     }).css("margin-top", "5px");
     span = $('<span>', {
         class: "input-group-addon form-span",
         text: namestr,
     });
     input = $('<input>', {
         class: "form-control",
         name: namestr,
         placeholder: namestr,
         type: inputType,
         value: inputValue
     });
     containerInput.append(
         span,
         input,
     );
     return containerInput;
 }