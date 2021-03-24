

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
           
            <div class="pull-left info">
             <?php
							
										echo '<p>';echo $data['username']; echo'</p>';

	?>
          
            </div>
            <br>
        
          </div>
          
          <!-- search form -->
          
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class=" treeview">
              <a href="<?php echo URLROOT; ?>/customer/index">
                <i class="fa fa-bed"></i> <span>Register Customer</span>
              </a>
            </li>
            <li class=" treeview">
              <a href="<?php echo URLROOT; ?>/customer/getworkflow">
              <i class="fa fa-id-card"></i> <span>Workflow </span>
              </a>
            </li>
            <li class=" treeview">
              <a href="<?php echo URLROOT; ?>/functions/service">
              <i class="fa fa-id-card"></i> <span>Services </span>
              </a>
            </li>
         
          
     
           
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>