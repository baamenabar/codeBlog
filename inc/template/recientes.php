<?php $recientes = getMostRecent($articleList,6); ?>
<ul>
										<?php foreach ($recientes as $ua): ?>
										<li>
											<a href="./article_<?php echo urlencode($ua['cleanname']); ?>.html"<?php if (isset($ua['subtitle'])): ?>
													title="<?php echo $ua['subtitle']; ?>"
												<?php endif ?>><?php echo $ua['title']; ?></a>
										</li>
										<?php endforeach ?>
									</ul>