

<?php  include("../classes/Database.php");
const deleteTask = (id) => {
  fetch(`http://localhost:3000/tasks/${id}`, {
    method: 'DELETE'
  })
  .then(response => {
    if (response.ok) {
      console.log(`Task with id ${id} has been deleted`);
    } else {
      console.error(`Error deleting task with id ${id}: ${response.status}`);
    }
  })
  .catch(error => console.error(error));
};
?>