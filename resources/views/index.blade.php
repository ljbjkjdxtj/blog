@extends('layouts.app')

@section('content')
		<div id="main" class="content">
			<div class="container">
				<article itemscope="itemscope">
					<div class="posts-list js-posts">

						<div class="post post-layout-list" data-aos="fade-up">
							<div class="postnormal review ">
								<div class="post-container review-item">
									<div class="row review-item-wrapper">
										<div class="col-sm-3">
											<a rel="nofollow" href="/detail">
												<div class="review-item-img" style="background-image: url(statics/images/yarn-150x150.jpg);"></div>
											</a>
										</div>
										<div class="col-sm-9 flex-xs-middle">
											<div class="review-item-title">
												<a href="/detail" rel="bookmark">我才不会写年终总结之瞎说篇</a>
											</div>
											<div class="review-item-creator"><b>发布日期：</b>2017-12-30</div>
{{--											<span class="review-item-info"><b>总浏览量：</b>1203 reads</span>--}}
										</div>
									</div>
									<div class="review-bg-wrapper">
										<div class="bg-blur" style="background-image: url(statics/images/yarn-150x150.jpg);"></div>
									</div>
								</div>
								<div class="post-container">
									<div class="entry-content">确实讨厌去写所谓的年终总结，在公司已经被动的想领导上交一个总结，自己就懒得去总结，不然，我觉得脑子里应该会编写出八九不离十的内容，所以正经八儿的事情略了，瞎说一下。 年初的人事调动是个人最不能接受的事情，但不接受也得接受，老板一句“这是命令...</div>
									<div class="post-footer">
										<a class="gaz-btn primary" href="/detail">READ MORE</a>
										<span class="total-comments-on-post pull-right"><a href="">31 Comments</a></span>
									</div>
								</div>
							</div>
						</div>


					</div>
					<!-- post-formats end Infinite Scroll star -->
					<!-- post-formats -->
					<div class="pagination js-pagination">
						<div class="js-next pagination__load">
							<a href=""><i class="iconfont">&#xe605;</i></a>
						</div>
					</div>
					<!-- -pagination  -->
                </article>
			</div>
		</div>
@endsection

