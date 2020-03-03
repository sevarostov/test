
<?php include ROOT . '/views/layouts/header.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js?v20191227"></script>

<!-- Main Content -->
<div class="container">
    <div class="row">
    	<div>
    		<br>
    		<br>
    		<br>
			<?php if (User::isGuest()): ?>
                <li class="nav-item">
                   <a href="/user/login/" class="nav-link border border-light rounded waves-effect" >
                     <i class="fa fa-user"></i>Вход
                    </a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a href="/user/logout/"class="nav-link border border-light rounded waves-effect" >
                        <i class="fa fa-unlock"></i> Выход</a>
                    </li>
                <?php endif; ?>
		</div>

		<?php if ($message != null): ?>
			<div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;
                        </button>
                <strong>Ваша заявка сохранена. </strong>
            </div>
		<?php endif; ?>


        <h1 style="margin-top: 50px;"> Cписок задач </h1>

		<div class="table-responsive table-end">
			<table class="table table-striped">
				<thead>
				<tr>
					<th></th>
					<th> 
						<a href="?sortBy=name&sortDir=<?php if ($sortDir == 1): ?> -1 <?php else: ?> 1 <?php endif; ?>">
							Имя пользователя
							<?php if ($sortField == 'name'): ?>
								<span class="glyphicon glyphicon-arrow-<?php if ($sortDir == 1): ?>down<?php else: ?>up<?php endif; ?>"></span>
							<?php endif; ?>
						</a>
					</th>
					<th>
						<a href="?sortBy=email&sortDir=<?php if ($sortDir == 1): ?> -1 <?php else: ?> 1 <?php endif; ?>">
							E-Mail
							<?php if ($sortField == 'email'): ?>
								<span class="glyphicon glyphicon-arrow-<?php if ($sortDir == 1): ?>down<?php else: ?>up<?php endif; ?>"></span>
							<?php endif; ?>
						</a>
					</th>
					<th>Текст задачи</th>
					<th>
						<a href="?sortBy=state&sortDir=<?php if ($sortDir == 1): ?> -1 <?php else: ?> 1 <?php endif; ?>">
							Статус
							<?php if ($sortField == 'state'): ?>
								<span class="glyphicon glyphicon-arrow-<?php if ($sortDir == 1): ?>down<?php else: ?>up<?php endif; ?>"></span>
							<?php endif; ?>
						</a></th>
				</tr>
				</thead>
				<tbody>
					<?php if ($list != null): ?>
					<?php foreach ($list as $listItem): ?>
			            <tr>
							<td></td>
							<td><?php echo $listItem['name']; ?></td>
							<td><?php echo $listItem['email']; ?></td>
							<?php if (!(User::isGuest())): ?>
								<td>
									<div class="form-group">
										<input class="form-control success" type="text" data-id="<?php echo $listItem['id']; ?>" name="text" value="<?php echo $listItem['text']; ?>">
										<input type="hidden" id="<?php echo $listItem['id']; ?>" name="id" >
									</div>
								</td>
							<?php else: ?>
								<td><?php echo $listItem['text']; ?></td>
							<?php endif; ?>
							<?php if (!(User::isGuest())): ?>
								<td>
									<div class="form-group">
										<input class="form-control success" type="text" data-id="<?php echo $listItem['id']; ?>" name="success" value="<?php echo $listItem['state']; ?>">
										<input type="hidden" id="<?php echo $listItem['id']; ?>" name="id" >
									</div>
								</td>
							<?php else: ?>
								<td><?php echo $listItem['state']; ?></td>
							<?php endif; ?>
						</tr>
			        <?php endforeach; ?>
			        <?php endif; ?>
				</tbody>
			</table>
		</div>
		<div>
			<ul class="pager">
                <li class="next">
                    <a href="/new/"> Создать </a>
                </li>
            </ul>
		</div>

		<?php if ($total > 3): ?>
			
	        <div id="paging"><p>
	       <?php echo $prevlink; ?>
			Стр. <?php echo $page; ?> из <?php echo $pages; ?>
	      <?php echo $nextlink; ?></p></div>
        <?php endif; ?>
        
    </div>
</div>

<hr>

<script>
		$(document).ready(function () {

			$('input[name=success]').on("change", function () {

					$.ajax({
						type: 'post',
						url: "/new/edit/",
						data: 'id=' + $(this).data('id') + '&success=' + $(this).val(),
						response: 'text',
						success: function (data) {
						}
					});
				
				
			});

			$('input[name=text]').on("change", function () {

					$.ajax({
						type: 'post',
						url: "/new/text/",
						data: 'id=' + $(this).data('id') + '&text=' + $(this).val(),
						response: 'text',
						success: function (data) {
						}
					});
				
				
			});

		});
	</script>


<?php include ROOT . '/views/layouts/footer.php'; ?>