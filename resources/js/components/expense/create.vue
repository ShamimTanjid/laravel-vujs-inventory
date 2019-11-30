<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Category</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row  container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            CategoryCategory Insert 
            <router-link to="/expense" class="btn btn-sm btn-info" id="add_new"> All Category</router-link>
          </div>
            <div class="card-body">
          	  <form @submit.prevent="expenseInsert">
                <div class="form-group">
	              <div class="form-row">
	              <div class="col-md-12">              
	               <div class="form-group">
				    <label for="exampleFormControlTextarea1">Details</label>			    
				    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"v-model="form.details"></textarea>
				   <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
				  </div>				            
	             </div>	             	          	          
	              <div class="col-md-12">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.amount" class="form-control">
	                  <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
	                  <label for="firstName">Full Name</label>
	                </div>
	               </div>                         	             	                         
	               </div>
	               </div>              	 	                        
               <button type="submit" class="btn btn-success">Submit</button>
              </form>
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
	 		form:{
	 			details: '',
	 			amount:'',
	 			

	 					 			
	 		},
	 		errors:{},

	 		
	 	}
	 },
	 methods:{ 		
	 	expenseInsert(){
        		axios.post('/api/expense/',this.form)
        		.then( ()=>{
        			this.$router.push({ name:'expense'})
        			Notification.success()
        		})
        		.catch(error => this.errors = error.response.data.errors)
        	},
	 }
	
	}
</script>



<style type="text/css">
	#add_new{
	float: right;
}
</style>