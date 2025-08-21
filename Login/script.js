function showForm(formId){
    document.querySelectorAll(".form-box").forEach(form => form.classList.remove("active"));
    document.getElementById(formId).classList.add("active");
}


 /* 
 function showContent(id){
            const contents = document.getElementsByClassName('contents');

            for(let i = 0; i < contents.length; i++){
                contents[i].classList.remove('active');
            }
            document.getElementById(id).classList.add('active');
        }
 
 window.onpageshow = function(event){
            if (event.persisted){
                window.location.reload();
            }
        }; */


     function showContent(id){
        const content = document.getElementsByClassName('content');

        for(let i = 0; i < content.length; i++){
            content[i].classList.remove('active');
        }
        document.getElementById(id).classList.add('active');
    }