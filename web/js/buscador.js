document.addEventListener("keyup", e=>{

  if(e.target.matches('#buscador')){

      document.querySelectorAll(".nombre_articulo").forEach(articulo =>{
        if (articulo.textContent.toLowerCase().includes(e.target.value.toLowerCase()) ) {
            
            articulo.parentElement.parentElement.parentElement.classList.remove("filtro");
        
        } else {

            articulo.parentElement.parentElement.parentElement.classList.add("filtro");
        }


        //articulo.textContent.toLowerCase().includes(e.target.value.toLowerCase()) 
        //? articulo.parentElement.parentElement.classList.remove("filtro")
        //: articulo.parentElement.parentElement.classList.add("filtro");

      })
  }

})