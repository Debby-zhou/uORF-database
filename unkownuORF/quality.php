<?php
//把檔案名存取起來
exec("ls SRA/fastq/",$sra);
$seg = "/(SRR\d+).fastq/";
$len = count($sra);
for($i=0;$i<$len;$i++){
	preg_match($seg,$sra[$i],$match);
	if(isset($match[1])) $sra_name[$i]=$match[1];
}

//處理fastq的品質
for($j=0;$j<$len;$j++){
	shell_exec("cutadapt -a file:adapt.fa -O4 -m 35 -j 2 -o /data/debby/rna-seq/trimmed/".$sra_name[$j].".fq /data/debby/rna-seq/rawdata/".$sra[$j]);
	shell_exec("fastq_quality_filter -Q33 -q 20 -p 70 -i /data/debby/rna-seq/trimmed/".$sra_name[$j].".fq -o /data/debby/rna-seq/rawdara/".$sra_name[$j]."_qf.fq");
	shell_exec("fastq_quality_trimmer -Q33 -t 20 -l 35 -i /data/debby/rna-seq/trimmed/".$sra_name[$j]."_qf.fq -o /data/debby/rna-seq/trimmed/".$sra_name[$j]."_qt.fq");
}
unset($sra);
unset($sra_name);

?>
