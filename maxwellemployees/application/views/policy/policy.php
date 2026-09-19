<?php
$totalPolicies   = count($UsersData);
$acknowledgedIds = isset($acknowledged) ? $acknowledged : [];
?>

<style>
/*	html, body {
		height: 100%;
		margin: 0;
		padding: 0;
		background-color: #f4f6f9;
		overflow-y: hidden;
	}
*/
	.policy-shell{
		max-width:1400px;
		margin:80px auto;
		padding:0 16px;
		height:calc(100vh - 60px);
		overflow:hidden;
	}

	.policy-card{
		height:100%;
		background:#fff;
		border-radius:16px;
		box-shadow:0 12px 36px rgba(0,0,0,.06);
		display:flex; /* Default: Horizontal layout */
		overflow:hidden;
	}

	.policy-nav{
		width: 30%;
		background:#fafbfd;
		border-right:1px solid #edf0f4;
		padding:24px;
		display:flex;
		flex-direction:column;
		height:100%;
		flex-shrink:0;
		overflow:hidden;
	}
	.policy-list{
		flex:1;
		overflow-y:auto;
		padding-right:6px;
	}
	.policy-btn{
		width:100%;
		padding:14px 18px;
		border:none;
		border-radius:999px;
		background:#eef5ff;
		color:#113a73;
		font-weight:600;
		margin-bottom:12px;
		text-align:left;
		cursor:pointer;
		transition:.2s;
	}
	.policy-btn:hover{background:#dce9fc;}
	.policy-btn.active{background:#ff6b6b;color:#fff;}
	.policy-btn.acknowledged{background:#e6f9ee;color:#1f7a3f;}
	.policy-btn.acknowledged.active{background:#1f7a3f;color:#fff;}

	.policy-view{
		width: 70%;
		display:flex;
		flex-direction:column;
		height:100%;
		padding:28px 34px;
		overflow:hidden;
	}

	.policy-title{font-size:24px;font-weight:700;}

	:root {
		--policy-footer-height: 80px;
		--policy-footer-padding: 14px;
	}

	.policy-content{
		flex:1;
		overflow-y:auto;
		padding-right:10px;
		line-height:1.7;
		min-height: 0;
		padding-bottom: calc(var(--policy-footer-height) + var(--policy-footer-padding));
	}

	.policy-footer{
		flex-shrink:0;
		position: sticky;
		bottom: 0;

		border-top:1px solid #edf0f4;
		padding-top: var(--policy-footer-padding);
		padding-bottom: var(--policy-footer-padding);
		background: #fff;
		margin-left: -34px;
		margin-right: -34px;
		padding-left: 34px;
		padding-right: 34px;

		min-height: calc(var(--policy-footer-height) - (var(--policy-footer-padding) * 2));

		display: flex;
		justify-content: space-between;
		align-items: center;
		width: 100%;
	}

	.policy-footer button{
		background:#ff6b6b;
		border:none;
		color:#fff;
		padding:10px 22px;
		border-radius:999px;
		font-weight:700;
		transition: background 0.2s;
	}
	.policy-footer button:disabled{background:#f3a5a5;}

	.success-badge{
		display:none;
		background:#e9fff1;
		color:#1f7a3f;
		padding:6px 10px;
		border-radius:6px;
		font-size:13px;
		font-weight:600;
	}


	@media(max-width:991px){
		html, body {
			overflow-y: auto;
		}
		.policy-shell{
			height:100dvh;
			margin:0;
			padding:0;
			min-height: 100dvh;
		}
		.policy-card{
			height:100%;
			border-radius:0;
			box-shadow:none;
			flex-direction:column;
		}

		.policy-nav{
			width:100%;
			max-height:25vh;
			padding:15px;
			border-right:none;
			border-bottom:1px solid #edf0f4;
			flex-shrink:0;
		}
		.policy-nav h4{font-size:18px;}
		.policy-list{
			max-height:20vh;
			padding-right:0;
		}
		.policy-btn{
			padding:10px 14px;
			font-size:14px;
		}

		.policy-view{
			width:100%;
			flex:1;
			padding:16px;
			min-height:0;
		}
		.policy-title{font-size:20px;}

		.policy-footer {
			flex-direction: column;

			margin-left: -16px;
			margin-right: -16px;
			padding-left: 16px;
			padding-right: 16px;

			padding-top: 10px;
			padding-bottom: 10px;
			min-height: 200px !important;
		}

		.policy-content {
			padding-bottom: calc(var(--policy-footer-height) - 80px);
			max-height: 35%;
		}

		#actionArea {
			flex-direction: column;
			align-items: center !important;
			width: 100%;
			gap: 10px;
		}

		#actionArea > label {
			order: 2;
		}

		#actionArea > div {
			order: 1;
			width: 100%;
			display: flex;
			justify-content: center;
			gap: 10px;
		}

		#ackBtn {
			width: 100%;
		}

		.success-badge {
			width: 100%;
			text-align: center;
		}
	}
</style>

<div class="policy-shell container-fluid">
	<div class="policy-card">

		<div class="policy-nav">
			<h4>Employee Policies</h4>
			<div class="text-muted mb-3 small">Read and acknowledge each policy</div>

			<div class="policy-list">
				<?php foreach($UsersData as $i=>$p):
					$isAck = in_array($p->id,$acknowledgedIds);
					$btnClass = $isAck ? 'acknowledged' : '';
					?>
					<button
							class="policy-btn <?= $btnClass ?>"
							data-index="<?= $i ?>"
							data-id="<?= $p->id ?>"
							data-title="<?= htmlspecialchars($p->title,ENT_QUOTES) ?>"
							data-content="<?= htmlspecialchars($p->description,ENT_QUOTES) ?>"
					>
						<span style="margin-right:6px;"><?= $isAck ? '✓ ' : '○ ' ?></span><?= htmlspecialchars($p->title) ?>
					</button>
				<?php endforeach;?>
			</div>
		</div>

		<div class="policy-view">

			<div class="policy-title" id="policyTitle">Select a policy to view...</div>

			<div class="my-3">
				<div class="progress" style="height:8px;">
					<div class="progress-bar bg-danger" id="progressFill" style="width:0%;"></div>
				</div>
				<div class="small text-muted mt-1" id="progressText">0 / 0 acknowledged</div>
			</div>

			<div class="policy-content" id="policyContent">
				<p class="text-center text-muted pt-5">Please select a policy from the list on the left to begin the acknowledgement process.</p>
			</div>

			<div class="policy-footer">

				<div id="actionArea" class="d-flex justify-content-between align-items-center w-100">
					<label>
						<input type="checkbox" id="ackCheck" disabled>
						I have read and understood this policy
					</label>
					<div class="d-flex align-items-center gap-2">
						<span class="success-badge" id="successBadge">Acknowledged</span>
						<button id="ackBtn" disabled>Read full policy to continue</button>
					</div>
				</div>

				<div id="alreadyAckMsg"
					 class="text-center fw-semibold text-success p-2 rounded"
					 style="display:none;background:#e9fff1;">
					✅ You have already acknowledged this policy.
				</div>

			</div>

		</div>

	</div>
</div>
<script>
    const POLICY_DATA = {
        acknowledgedIds: <?= json_encode(array_map('intval',$acknowledgedIds)) ?>,
        totalPolicies: <?= (int)$totalPolicies ?>,
        acknowledgeUrl: "<?= site_url('Employee/acknowledge') ?>",
        redirectUrl: "<?= site_url('Common/verifyLogin') ?>",
        viewpage: 1,
    };
</script>
