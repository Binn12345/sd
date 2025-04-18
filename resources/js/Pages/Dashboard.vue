<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import TaskList from "@/Components/TaskList.vue";
</script>



<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div>
            <h1 class="text-2xl font-bold mb-4">Your Tasks</h1>
            <TaskList />
        </div>
        </div>
        <br>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <Welcome />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
