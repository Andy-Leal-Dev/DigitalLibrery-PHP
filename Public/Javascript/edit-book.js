const form = document.getElementById('form-edit');
const id = document.querySelector('.div-info').dataset.id;
document.getElementById('btn-edit').addEventListener('click', async () => {
   
    const formData = new FormData(form);

        fetch('./Controller/edit-book-controller.php', { 
              method: 'POST', 
              body: formData, 
          }).then(response => response.json()).then(data =>{
                console.log(data);
                if (data.success) {
                    window.location.href = `/DigitalLibrary/book_edit.php?id=${id}&message=El libro se actualizo exitosamente`; 
                } else {
                    window.location.href = `/DigitalLibrary/book_edit.php?id=${id}&message=El libro No se pudo actualizar el libro`; 
                }
          })
    
      
      } );