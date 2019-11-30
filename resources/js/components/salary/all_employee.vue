<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">salary</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row  card container">
        <div class="card-header">
            <i class="fas fa-chart-area"></i>
            salary Insert 
           
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
                   
                     <td>                      
                       <router-link :to="{ name: 'pay-salary', params:{id:employee.id} }" class="btn btn-sm btn-info">Pay Salary</router-link>
                        
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