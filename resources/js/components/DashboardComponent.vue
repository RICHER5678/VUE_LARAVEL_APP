<template>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="container p-4 bg-dark mt-4 ">
        <h2 class="text-left pb-4">Create Organisation</h2>
        <form>
        <div class="row">
            <div class="col-md-12 text-light">
                <div class="row g-3">
  <div class="col">
    <label for="inputEmail4" class="form-label">Organisation</label>
    <input type="text" class="form-control" placeholder="" aria-label="First name" required>
  </div>
  <div class="col">
    <label for="inputEmail4" class="form-label">Sender ID</label>
    <input type="text" class="form-control" placeholder="" aria-label="Last name" required>
  </div>
</div>
            </div>
            <!-- <div class="col-md-6 text-light">hello2</div> -->
        </div>
        <button type="submit" class="btn btn-success mt-4">Create&nbsp;<i class="fa fa-plus-circle"></i></button>
        </form>
    </div>
</template>


<script scoped>
export default{
    name: 'dashboard'
  

}


</script>

<style scoped>
</style>