<script setup>
</script>

<template>
  <div class="pt-16">
    <h1 class="text-3xl font-semibold mb-4">
        Enter your phone number
    </h1>
    <form action="#">
        <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
            <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="">
                        <input type="text" name="phone" id="phone" autocomplete="phone" placeholder="1 (234) 567-9874" class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm">
                    </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit
                </button>
            </div>
        </div>
    </form>
  </div>


</template>

<style scoped>

</style>
