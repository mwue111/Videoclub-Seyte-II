function confirmErase(route){
    console.log(route);
    if(confirm("¿Seguro/a que desea eliminar esta película?")){
        window.location.href = route;
    }

    return false;
}
