package Scoring;

import java.util.ArrayList;
import java.util.HashMap;

import DataStructures.DocFreqTuple;
import DataStructures.InvertedIndexDic;
import DataStructures.Query;
import DataStructures.QueryTerm;

public class BM25L {
	static double k1 = 0.4;
	static double b = 0.1;
	static double k3 = 1000;
	static double lamda = 0.5;
	
	public static HashMap<Integer, Double> getRawScore(Query q, InvertedIndexDic dictionary, int docTotal, double avgLength){
		ArrayList<QueryTerm> termList = q.termList;
		HashMap<Integer, Double> scoreBoard = new HashMap<Integer, Double>();
		for(int i = 0; i < termList.size(); i++){
			QueryTerm current = termList.get(i);
			double weight = current.termWeight;			
			double queryScore = ((k3+1)*weight)/(k3+weight);
			double IDF;
			ArrayList<DocFreqTuple> docList = dictionary.getDocumentList(current.termID);
			if(docList == null){
				continue;
			}
			else{
				IDF = (docTotal + 1)/(docList.size()+0.5);
			}
			for(int j = 0; j < docList.size(); j++){
				DocFreqTuple tuple = docList.get(j);
				double normalizedCount = tuple.termFreq / (1 - b + b * tuple.docLength / avgLength);
				if(normalizedCount > 0){
					double normalizedTF = ((k1 + 1) * (normalizedCount + lamda))/(k1+(normalizedCount+lamda));
					double rawScore = queryScore * IDF * normalizedTF;
					double previousScore = (scoreBoard.get(tuple.docID)==null)?0:scoreBoard.get(tuple.docID);
					scoreBoard.put(tuple.docID, rawScore + previousScore);
				}
			}
		}
		return scoreBoard;
	}
}
