function confirmErase(id, route){
    if(confirm("¿Seguro/a que desea eliminar esta película?")){
        window.location.href = route + id;
    }
}
