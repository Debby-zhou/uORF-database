<?php
$path = "/data/debby/uorf_rna-seq/";

//建立Athaliana索引
shell_exec("hisat2-build -p 8 -f ".$path."mapping/index/genome.fa Athaliana");
shell_exec("samtools faida ".$path."mapping/index/genome.fa");
//每個SRR序列比對後存成.sam
exec("ls ".$path."trimmeddata/",$fq);
$len = count($fq);
$i = 0;
while($i<$len){
	preg_match("/(SRR\d+)_qt.fq/",$fq[$i],$match);
	shell_exec("hisat2 -t -x ".$path."mapping/index/Athaliana -U ".$path."trimmeddata/".$fq[$i]." -S ".$path."/mapping/sam/".$match[1].".sam");
	//將.sam轉成.bam
	shell_exec("samtools import ".$path."mapping/index/genome.fa.fai ".$path."mapping/sam/".$match[1].".sam ".$match[1].".bam");	
	//sort .bam
	shell_exec("samtools sort -")
	$i++;
}
?>
