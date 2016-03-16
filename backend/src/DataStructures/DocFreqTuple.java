package DataStructures;

public class DocFreqTuple {
	public int docID;
	public int termFreq;
	public int docLength;
	
	public DocFreqTuple(int docID, int termFreq, int docLength){
		this.docID = docID;
		this.termFreq = termFreq;
		this.docLength = docLength;
	}
}
