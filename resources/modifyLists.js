let getButton = document.querySelectorAll(".list-button");

for(let i = 0; i < getButton.length; i++){
      
    getButton[i].addEventListener("click",function(){
        let inputspace = document.querySelector("#inputspace");
        inputspace.style.display = "flex";

        let value = getButton[i].value;
        switch(value){
            case 'addList':
                inputspace.innerHTML ='<form method="POST" action="?url=alter_lists_action"><label>New List Name: </label><input type="text" name="listname"><input type="submit" value="addList" name="modify"/></form>';
                break;
            case 'addTask':
                inputspace.innerHTML ='<form method="POST" action="?url=alter_lists_action"><label>Select List:</label><input type="text" name="listname"><label>New Task Name: </label><input type="text" name="taskname"><input type="submit" value="addTask" name="modify"/></form>';
                break;
            case 'delList':
                inputspace.innerHTML ='<form method="POST" action="?url=alter_lists_action"><label>Delete List (Name): </label><input type="text" name="listname"><input type="submit" value="delList" name="modify"/></form>';
                break;
            case 'delTask':
                inputspace.innerHTML ='<form method="POST" action="?url=alter_lists_action"><label>Delete Task (Name): </label><input type="text" name="taskname"><input type="submit" value="delTask" name="modify"/></form>';
                break;
            case 'alterTask':
                inputspace.innerHTML ='<form method="POST" action="?url=alter_lists_action"><label>Task to modify:</label><input type="text" name="taskname"><label>New Task Name: </label><input type="text" name="newtaskname"><input type="submit" value="alterTask" name="modify"/></form>';
                break;
        }
    },false);

}


