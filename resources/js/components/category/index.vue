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
            <router-link to="/store-category" class="btn btn-sm btn-info" id="add_new">Add New</router-link>
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
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
                  <tr v-for= "category in filterSearch" :key="category.id">
                    <td>{{category.category_name}}</td>                                   
                     <td>                      
                       <router-link :to="{ name: 'edit-category', params:{id:category.id} }" class="btn btn-sm btn-info">Edit</router-link>
                        <a @click="deleteCategory(category.id)" class="btn btn-sm btn-danger">Delete</a>
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
        categories:[],
        searchTerm:'',
      }
    },
    computed:{
      filterSearch(){
        return  this.categories.filter(category => {
           return category.category_name.match(this.searchTerm)
         })
      }
    },
    methods:{
      allCategory(){
        axios.get('/api/category/')
        .then(({data}) =>(this.categories = data))
        .catch()
      },
      deleteCategory(id){
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
      this.allCategory();
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