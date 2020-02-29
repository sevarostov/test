
<?php include ROOT . '/views/layouts/header.php'; ?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <h1 style="margin-top: 50px;"> Cписок задач </h1>

		<div class="table-responsive table-end">
			<table class="table table-striped">
				<thead>
				<tr>
					<th></th>
					<th>Имя пользователя</th>
					<th>E-Mail</th>
					<th>Текст задачи</th>
					<th>Статус</th>
				</tr>
				</thead>
				<tbody>
					<?php foreach ($list as $listItem): ?>
			            <tr>
							<td></td>
							<td><?php echo $listItem['name']; ?></td>
							<td><?php echo $listItem['email']; ?></td>
							<td><?php echo $listItem['text']; ?></td>
							<td><?php echo $listItem['state']; ?></td>
						</tr>
			        <?php endforeach; ?>
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
		
        
    </div>
</div>

<hr>

<?php include ROOT . '/views/layouts/footer.php'; ?>