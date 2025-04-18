<template>
    <div>
      <input v-model="newTask" @keyup.enter="addTask" placeholder="Add task" class="border p-2 mb-2" />
      <ul>
        <li v-for="task in tasks" :key="task.id" class="flex justify-between items-center">
          <span :class="{ 'line-through': task.completed }" @click="toggleComplete(task)">
            {{ task.title }}
          </span>
          <button @click="deleteTask(task.id)" class="text-red-500">🗑</button>
        </li>
      </ul>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios'

  // Make sure to set this globally, so cookies are sent with every request
  axios.defaults.withCredentials = true
  axios.defaults.baseURL = 'http://127.0.0.1:8000';  // Laravel API base URL

  const tasks = ref([])
  const newTask = ref('')

  // Function to get tasks
  const getTasks = async () => {
    await axios.get('/sanctum/csrf-cookie') // Ensure CSRF cookie is set
    const response = await axios.get('/api/tasks')  // Fetch tasks
    tasks.value = response.data
  }

  // Function to add a new task
  const addTask = async () => {
    if (newTask.value === '') return
    await axios.get('/sanctum/csrf-cookie')  // Ensure CSRF cookie is set
    const response = await axios.post('/api/tasks', { title: newTask.value })  // Add task
    tasks.value.push(response.data)
    newTask.value = ''
  }

  // Function to toggle task completion
  const toggleComplete = async (task) => {
    task.completed = !task.completed
    await axios.get('/sanctum/csrf-cookie')  // Ensure CSRF cookie is set
    await axios.put(`/api/tasks/${task.id}`, task)  // Update task
  }

  // Function to delete task
  const deleteTask = async (id) => {
    await axios.get('/sanctum/csrf-cookie')  // Ensure CSRF cookie is set
    await axios.delete(`/api/tasks/${id}`)  // Delete task
    tasks.value = tasks.value.filter(t => t.id !== id)
  }

  // Fetch tasks when the component mounts
  onMounted(() => {
    getTasks()
  })
</script>

  