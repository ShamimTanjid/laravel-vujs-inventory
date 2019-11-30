<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">All Customer</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row card container">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Customer Insert 
            <router-link to="/store-customer" class="btn btn-sm btn-info" id="add_new"> Add New</router-link>
          </div>
          <div class="card-body">
            <div class="card-body">
            <div class="table-responsive">
              <label>Search</label>
              <input type="text" v-model="searchTerm" class="form-control" style="width: 200px;">
              <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Phone</th>                 
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
                  <tr v-for="customer in filterseach" :key="customer.id">
                    <td>{{customer.name}}</td>
                    <td><img :src="customer.photo" id="emp_img"></td>
                    <td>{{customer.phone}}</td>
                    <td>{{customer.address}}</td>
                    <td>
                        <router-link :to="{name: 'edit-customer',params:{id:customer.id} }" class="btn btn-sm btn-info">Edit</router-link>
                    
                    <a @click="deleteCustomer(customer.id)" class="btn btn-sm btn-info">Delete</a>
                    </td>

                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
       </div>
   </div>
</template>



<script type="text/javascript">
	 export default {
	 	created(){
	 		if(!User.loggedIn()){
	 			this.$router.push({name : '/'})
	 		}
	 	},
    data(){
      return {
        customers:[],
        searchTerm:''

        
      }
    },
    computed:{
      filterseach(){
        return this.customers.filter(customer =>{
          return customer.name.match(this.searchTerm)
        })
      }

    },
      methods:{
        allCustomer(){
          axios.get('/api/customer/')
          .then(({data}) => (this.customers = data))
          .catch()

        },
        deleteCustomer(id){
          Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
})
  .then((result) => {
  if (result.value){
     axios.delete('/api/customer/'+id)
     .then(() =>{
        this.customers = this.customers.filter(customer =>{
          return customer.id !=id
        })
     })
     .catch(()=>{
       this.$router.push({ name:'customer'})
     })
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})

        }
      },
      created(){
        this.allCustomer();

      }
    
	 
	
	}
</script>


<style type="text/css">
  
  #add_new{
  float: right;
}
  #emp_img{
     height:  40px;
     width:  40px;
  
}
</style> 