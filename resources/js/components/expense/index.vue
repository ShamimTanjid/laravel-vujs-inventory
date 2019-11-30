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
            <router-link to="/store-expense" class="btn btn-sm btn-info" id="add_new">Add New</router-link>
          </div>
           <div class="card-body">
           <div class="card-body">
            <div class="table-responsive">
              <label>Search</label>
              <input type="text" v-model="searchTerm" class="form-control" style="width:200px;">
              <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Details</th> 
                     <th>Amount</th>                                  
                    <th>Action</th>
                   </tr>
                  </thead>
                
                <tbody>
                  <tr v-for= "expense in filterSearch" :key="expense.id">
                    <td>{{expense.details}}</td>
                    <td>{{expense.amount}}</td>                                    
                     <td>                      
                       <router-link :to="{ name: 'edit-expense', params:{id:expense.id} }" class="btn btn-sm btn-info">Edit</router-link>
                        <a @click="deleteCategory(expense.id)" class="btn btn-sm btn-danger">Delete</a>
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
        expenses:[],
        searchTerm:'',
      }
    },
    computed:{
      filterSearch(){
        return  this.expenses.filter(expense => {
           return expense.expense_date.match(this.searchTerm)
         })
      }
    },
    methods:{
      allExpense(){
        axios.get('/api/expense/')
        .then(({data}) =>(this.expenses = data))
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
     axios.delete('/api/expense/'+id)
     .then(() =>{
        this.expenses = this.expenses.filter(expense =>{
          return expense.id !=id
        })
     })
     .catch(()=>{
       this.$router.push({ name:'expense'})
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
      this.allExpense();
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