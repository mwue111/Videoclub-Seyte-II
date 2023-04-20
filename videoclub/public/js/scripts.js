function confirmErase(){
    if(confirm("¿Seguro/a que desea eliminar esta película?")){
        return true;
    }

    return false;
}

function selectedGenre(data){
    const genres = Array.from(document.querySelectorAll('input[name="genre_id[]"]:checked')).map((input) => parseInt(input.value));
    console.log(genres);
}
