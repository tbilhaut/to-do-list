// Function to delete a single task
async function deleteTask(id) {
    try {
      const response = await fetch(`delete.php?id=${id}`, { method: "DELETE" });
      if (response.ok) {
        const task = document.getElementById(id);
        task.remove();
      }
    } catch (error) {
      console.error(error);
    }
  }
  
  
  // Add event listeners to delete buttons
  const deleteButtons = document.querySelectorAll(".delete-btn");
  deleteButtons.forEach(button => {
    button.addEventListener("click", () => {
      const taskId = button.dataset.id;
      deleteTask(taskId);
    });
  });
  
  // Add event listener to delete all button
  const deleteAllButton = document.getElementById("delete-all-btn");
  deleteAllButton.addEventListener("click", deleteAllTasks);
  
  