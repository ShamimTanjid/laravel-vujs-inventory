<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Employee</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row  card container">
        <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Employee Insert 
            <router-link to="/store-supplier" class="btn btn-sm btn-info" id="add_new">Add New</router-link>
          </div>
           <div class="card-body">
           <div class="card-body">
            <div class="table-responsive">
              <label>Search</label>
              <input type="text" v-model="searchTerm" class="form-control" style="width:200px;">
              <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Phone</th>
                    <th>ShopName</th>
                    <th>Address</th>                   
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
                  <tr v-for= "supplier in filterSearch" :key="supplier.id">
                    <td>{{supplier.name}}</td>
                    <td><img :src="supplier.photo" id="emp_photo"></td>
                    <td>{{supplier.phone}}</td>                  
                    <td>{{supplier.shopname}}</td>
                    <td>{{supplier.address}}</td>                  
                     <td>                      
                       <router-link :to="{ name: 'edit-supplier', params:{id:supplier.id} }" class="btn btn-sm btn-info">Edit</router-link>
                        <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger">Delete</a>
                     </td>
                  </tr>
                  
                </tbody>
              </table>
            </div>
          </div>
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
      return{
        suppliers:[],
        searchTerm:''
      }
    },
    computed:{
      filterSearch(){
        return  this.suppliers.filter(supplier => {
           return supplier.phone.match(this.searchTerm)
         })
      }
    },
    methods:{
      allSupplier(){
        axios.get('/api/supplier/')
        .then(({data}) =>(this.suppliers = data))
        .catch()
      },
      deleteSupplier(id){
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
     axios.delete('/api/supplier/'+id)
     .then(() =>{
        this.suppliers = this.suppliers.filter(supplier =>{
          return supplier.id !=id
        })
     })
     .catch(()=>{
       this.$router.push({ name:'supplier'})
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
      this.allSupplier();
    }
	
	
	}
</script>



<style type="text/css">
	#add_new{
	float: right;
}
#emp_photo{
   height: 40px;
   width: 30px;
}
</style>