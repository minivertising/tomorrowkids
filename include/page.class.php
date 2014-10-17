<?
class Page
{
	var $pg; //-- ���� ������
	var $tot_no; //--��ü �Խù���
	var $page_size; //--�ѹ��� ������ �Խù���
	var $page_count; //--��ü ��������
	var $page_start; //--�Խù� ������ġ
	var $page_uncount; //--�Խù� ��ȣ
	
	var $block_size; //--�ѹ��� ������ �ҷ���
	var $block_count; //--��ü �ҷ���
	var $block; //--���� �ҷ���
	var $block_start; //--�ҷ����ۼ�
	var $block_end; //--�ҷ� ����
	
	var $block_list; //--�ҷ��� ������ ���� ����
	var $script; //-- ���������� �ڹٽ�ũ��Ʈ
	
	function Page($class_pg,$class_tot_no,$class_page_size,$class_block_size){
		$this->pg = $class_pg;
		$this->tot_no = $class_tot_no;
		$this->page_size = $class_page_size;
		$this->block_size = $class_block_size;
		
		$this->page_count = ceil($this->tot_no/$this->page_size); //��ü ��������
		$this->page_start = ($this->pg - 1) * $this->page_size; //�Խù� ������ġ
		$this->page_uncount = $this->tot_no - $this->page_start; //�Խù� ��ȣ
		
		$this->block_count = ceil($this->page_count/$this->block_size);///////// ��ü �ҷ���
		$this->block = ceil($this->pg/$this->block_size); //////////////////////////// ���� �ҷ���
		$this->block_start = (($this->block - 1) * $this->block_size) + 1; ///////// �ҷ����ۼ�
		$this->block_end = $this->block * $this->block_size; /////////////////////// �ҷ� ����
	}
	
	function blockList( $str = "pageRun(")
	{
		$b_start = $this->block_start;
		$block_str = "";
		$block_str = '<table border="0" cellspacing="0" cellpadding="0"><tr><td>';
		//-- ���� ��
		if($this->block != 1)
		{
			$temp = $this->block_start - 1;
			$block_str .= '<a href="javascript:' . $str . $temp . ');" title="���� ' . $this->block_size . '">����</a>';
		}
		else
		{
			$block_str .= '����';
		}
		$block_str .= '</td><td>';
		//--�� ����Ʈ
		$arrBlock = array();
		while($b_start <= $this->block_end && $b_start <= $this->page_count )
		{
			$arrBlock[] = 	$b_start++;
		}
		
		for($i = 0; $i < count($arrBlock); $i++)
		{
			if($this->pg != $arrBlock[$i])
			{
				$block_str .= '<a href="javascript:'. $str.$arrBlock[$i] . ');">' . $arrBlock[$i] . '</a>';
			}
			else
			{
				$block_str .= '<a href="javascript:'. $str. $arrBlock[$i] . ');" style="font-weight:bold">' . $arrBlock[$i] . '</a>';
			}
			if($i < (count($arrBlock) - 1) ) $block_str .= " | ";
		}
		$block_str .= '</td><td>';
		
		//���� ��
		if($this->block != $this->block_count && $this->tot_no != 0){
			$temp = $this->block_end + 1;
			$block_str .= '<a href="javascript:' .$str . $temp . ')" title="���� ' . $this->block_size . '">����</a>';
		}
		else
		{
			$block_str .= '����';
		}
		$block_str .= '</td></tr></table>';
		return $block_str;
	}
	
	function blockList2( $str = "pageRun(")
	{
		$b_start = $this->block_start;
		$block_str = "";
		//-- ���� ��
		if($this->block != 1)
		{
			$temp = $this->block_start - 1;
			$block_str .= '<li><a href="javascript:' . $str . $temp . ');" title="���� ' . $this->block_size . '">&lt;</a></li>';
		}

		//--�� ����Ʈ
		$arrBlock = array();
		while($b_start <= $this->block_end && $b_start <= $this->page_count )
		{
			$arrBlock[] = 	$b_start++;
		}
		
		for($i = 0; $i < count($arrBlock); $i++)
		{
			if($this->pg != $arrBlock[$i])
			{
				$block_str .= '<li><a href="javascript:'. $str.$arrBlock[$i] . ');">' . $arrBlock[$i] . '</a></li>';
			}
			else
			{
				$block_str .= '<li><a class="p_now" href="javascript:'. $str.$arrBlock[$i] . ');">' . $arrBlock[$i] . '</a></li>';
			}
			if($i < (count($arrBlock) - 1) ) $block_str .= "  ";
		}
		
		//���� ��
		if($this->block != $this->block_count && $this->tot_no != 0){
			$temp = $this->block_end + 1;
			$block_str .= '<li><a href="javascript:' .$str . $temp . ')" title="���� ' . $this->block_size . '">&gt;</a></li>';
		}

		return $block_str;
	}

	function blockList3( $str = "pageRun(")
	{
		$b_start = $this->block_start;
		$block_str = "";
		//-- ���� ��
		if($this->block != 1)
		{
			$temp = $this->block_start - 1;
			$block_str .= '<span class="next"><a href="javascript:' . $str . $temp . ');">��</a>&nbsp;</span>';
		}

		//--�� ����Ʈ
		$arrBlock = array();
		while($b_start <= $this->block_end && $b_start <= $this->page_count )
		{
			$arrBlock[] = 	$b_start++;
		}
		
		for($i = 0; $i < count($arrBlock); $i++)
		{
			if($this->pg != $arrBlock[$i])
			{
				$block_str .= '<a href="javascript:'. $str.$arrBlock[$i] . ');">' . $arrBlock[$i] . '</a>';
			}
			else
			{
				$block_str .= '<a href="javascript:'. $str.$arrBlock[$i] . ');">' . $arrBlock[$i] . '</a>';
			}
			if($i < (count($arrBlock) - 1) ) $block_str .= " / ";
		}
		
		//���� ��
		if($this->block != $this->block_count && $this->tot_no != 0){
			$temp = $this->block_end + 1;
			$block_str .= '<span class="next">&nbsp;<a href="javascript:' .$str . $temp . ')">��</a></span>';
		}

		return $block_str;
	}

	function blockList4( $str = "pageRun(")
	{
		$b_start = $this->block_start;
		$block_str = "";

		$block_str .= '<ul class="con_paging">';
		//-- ���� ��
		if($this->block != 1)
		{
			$temp = $this->block_start - 1;
			$block_str .= '<li><a href="javascript:' . $str . $temp . ');">&lt;</a>&nbsp;</li>';
		}

		//--�� ����Ʈ
		$arrBlock = array();
		while($b_start <= $this->block_end && $b_start <= $this->page_count )
		{
			$arrBlock[] = 	$b_start++;
		}
		
		for($i = 0; $i < count($arrBlock); $i++)
		{
			if($this->pg != $arrBlock[$i])
			{
				$block_str .= '<li><a href="javascript:'. $str.$arrBlock[$i] . ');">' . $arrBlock[$i] . '</a></li>';
			}
			else
			{
				$block_str .= '<li><a class="p_now" href="javascript:'. $str.$arrBlock[$i] . ');">' . $arrBlock[$i] . '</a></li>';
			}
			//if($i < (count($arrBlock) - 1) ) $block_str .= " / ";
		}
		
		//���� ��
		if($this->block != $this->block_count && $this->tot_no != 0){
			$temp = $this->block_end + 1;
			$block_str .= '<li>&nbsp;<a href="javascript:' .$str . $temp . ')">&gt;</a></li>';
		}

		$block_str .= '</ul>';
		return $block_str;
	}
}
?>
