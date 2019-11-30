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
            <router-link to="/store-employee" class="btn btn-sm btn-info" id="add_new">Add New</router-link>
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
                    <th>Salary</th>
                    <th>Address</th>
                    <th>Joining_date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
                  <tr v-for= "employee in filterSearch" :key="employee.id">
                    <td>{{employee.name}}</td>
                    <td><img :src="employee.photo" id="emp_photo"></td>
                    <td>{{employee.phone}}</td>                  
                    <td>{{employee.salary}}</td>
                    <td>{{employee.address}}</td>
                    <td>{{employee.joining_date}}</td>
                     <td>                      
                       <router-link :to="{ name: 'edit-employee', params:{id:employee.id} }" class="btn btn-sm btn-info">Edit</router-link>
                        <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger">Delete</a>
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
        employees:[],
        searchTerm:''
      }
    },
    computed:{
      filterSearch(){
        return  this.employees.filter(employee => {
           return employee.phone.match(this.searchTerm)
         })
      }
    },
    methods:{
      allEmployee(){
        axios.get('/api/employee/')
        .then(({data}) =>(this.employees = data))
        .catch()
      },
      deleteEmployee(id){
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
     axios.delete('/api/employee/'+id)
     .then(() =>{
        this.employees = this.employees.filter(employee =>{
          return employee.id !=id
        })
     })
     .catch(()=>{
       this.$router.push({ name:'employee'})
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
      this.allEmployee();
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