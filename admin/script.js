const search = document.querySelector('.input-group input'),
table_rows = document.querySelectorAll('tbody tr');

search.addEventListener('input', searchTable);

function searchTable(){
    table_rows.forEach((row, i) => {
    
       row.classList.toggle('hide', table_data.indexOf(search_data)< 0);
        row.computedStyleMap.setProperty('--delay', i / 25 + 's');
    })

    document.querySelectorAll('tbody tr:not(.hide').forEach((visible_row, i)  =>{
        visible_row.computedStyleMap.backgroundColor = (i % 2 == 0)? 'transparent' : '#0000000b'
    })

}

function showContent(id){
    const contents = document.getElementsByClassName('content');
    for(let i = 0; i < contents.length; i++){
        contents[i].classList.remove('active');
    }
    document.getElementById(id).classList.add('active');
}

function viewContent(id){
    const contents = document.getElementsByClassName('Users');
    for (let i = 0; i < contents.length; i++){    
        contents[i].classList.remove('active');
    }
    document.getElementById(id).classList.add('active');
    
}

function displayContent(id){
    const content = document.getElementsByClassName('inventory');
    for(let i = 0; i < content.length; i++){
        content[i].classList.remove('active');
    }
    document.getElementById(id).classList.add('active');
}