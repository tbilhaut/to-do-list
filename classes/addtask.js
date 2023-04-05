function addTask(taskName) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'addTask.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        console.log('La tâche a été ajoutée avec succès');
      }
    };
    xhr.send('tache=' + encodeURIComponent(taskName));
  }
  