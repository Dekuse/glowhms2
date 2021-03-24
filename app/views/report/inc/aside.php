

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
              <a href="<?php echo URLROOT; ?>/administrator/bed">
                <i class="fa fa-bed"></i> <span>Bed</span>
              </a>
            </li>
            <li class=" treeview">
              <a href="<?php echo URLROOT; ?>/administrator/card">
              <i class="fa fa-id-card"></i> <span>Card </span>
              </a>
            </li>
            <li class=" treeview">
              <a href="<?php echo URLROOT; ?>/administrator/actor">
              <i class="fa fa-user"></i> <span>Actor </span>
              </a>
            </li>
            <li class=" treeview">
              <a href="<?php echo URLROOT; ?>/administrator/service">
              <i class="fa fa-briefcase"></i> <span>Services </span>
              </a>
            </li>
            <li class=" treeview">
              <a href="<?php echo URLROOT; ?>/administrator/user_role">
              <i class="fa fa-users"></i><span>Users & Roles </span>
              </a>
            </li>
          
     
           
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>