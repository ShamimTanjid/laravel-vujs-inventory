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
                    <th>Salary </th>                            
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
                   <tr v-for= "salary in filterSearch" :key="salary.salary_month">
                    <td>{{salary.salary_month}}</td>
                    
                   
                     <td>                      
                       <router-link :to="{ name: 'view-salary', params:{id:salary.salary_month} }" class="btn btn-sm btn-info">View Salary</router-link>
                        
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
        salaries:[],
        searchTerm:''
      }
    },
    computed:{
      filterSearch(){
        return  this.salaries.filter(salary => {
           return salary.salary_month.match(this.searchTerm)
         })
      }
    },
    methods:{
      allSalary(){
        axios.get('/api/salary/')
        .then(({data}) =>(this.salaries = data))
        .catch()
      },
      
    },
    created(){
      this.allSalary();
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