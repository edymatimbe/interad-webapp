//Select in voice

const  openInvoice= (event)=>{
        let element=event.target

        Swal.fire({

            html:
            `<div class="modal-div scroll-y"> <img class="modal-factura" src=${element.src}> </div>`,
            // imageUrl: element.src,
            // imageWidth: 730,
            // imageHeight: 800,
            customClass:'swal-wide',
            showCloseButton: false,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText:
                'Select',
            cancelButtonText:
                'Cancel',
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                let invoice_models =document.getElementsByClassName("box-fatura");
                for(invoice of invoice_models){
                    invoice.classList.remove("active-box-fatura");
                }
                let parentDiv=element.parentNode;
                    parentDiv.classList.add("active-box-fatura")
                    const column ='invoice_model';
                    const value = parentDiv.getAttribute('data-invoice_model');
                    $.ajax({
                        url: BASE_URL+'settings/updateColumn',
                        type: 'POST',
                        data: {column,value},
                        success: function (data) {
                            Swal.fire('Model selected!', '', 'success')
                        }
                    });
            } else {
                // let invoice_models =document.getElementsByClassName("box-fatura");
                // for(invoice of invoice_models){
                //     invoice.classList.remove("active-box-fatura");
                // }
            }
          })
        
}

function addEnventClick(){
    let invoice_models =document.getElementsByClassName("box-fatura");
    
    let choosen_model= document.getElementsByName("invoice_model")[0].value;

    for(invoice of invoice_models){
        if(choosen_model==invoice.getAttribute("data-invoice_model")){
            invoice.classList.add('active-box-fatura');
        }
        invoice.addEventListener('click', openInvoice )
    }
}




