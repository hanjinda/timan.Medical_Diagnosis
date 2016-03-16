package Driver;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Collections;
import java.util.HashMap;
import java.util.Iterator;

import feedback.RocchioFeedback;

import DataStructures.CustomComparator;
import DataStructures.DocReference;
import DataStructures.DocScoreTuple;
import DataStructures.InvertedIndexDic;
import DataStructures.Query;
import DataStructures.QueryTerm;
import Scoring.BM25L;
import Util.Util;
import Util.config;

public class SearchDriver {
	public static void main(String[] args) throws IOException{
		//Query q, 
		//InvertedIndexDic dictionary, 
		//int docTotal, 
		//double avgLength
		String rawQuery = args[0];
		int iteNum = Integer.parseInt(args[1]);
		String[] splitResult = rawQuery.split("_");
		HashMap<String, Integer> termDic = Util.getTermDic("TermIDMap");
		Query query = new Query(); 
		for(int i = 0; i < splitResult.length; i++){
			Integer termID = termDic.get(splitResult[i]);
			if(termID != null){
				query.update(new QueryTerm(termID));
			}
		}
		
		double avgLength = 218.5479417028893;
		//System.out.println(avgLength);
		/*loadTuples(avgLength)
		loadDocRef
		BM25L
		Rocchio
		writeFile*/
		ArrayList<DocReference> docReference = Util.parseReference("FileReference", termDic);
		InvertedIndexDic invertedDic = Util.parseInverted("InvertedIndex", docReference);
		HashMap<Integer, Double> currentScore = BM25L.getRawScore(query, invertedDic, docReference.size(), avgLength);
		HashMap<Integer, Double> newScore = RocchioFeedback.getFeedBackScore(currentScore, iteNum, query, docReference.size(), avgLength, invertedDic, docReference);
		printResult(currentScore);
		printResult(newScore);
	}

	private static void printResult(HashMap<Integer, Double> currentScore) throws IOException {
		Iterator<Integer> iter = currentScore.keySet().iterator();
		ArrayList<DocScoreTuple> topList = new ArrayList<DocScoreTuple>();
		while(iter.hasNext()) {
			Integer docID = (Integer)iter.next();
			double score = (double)currentScore.get(docID);
			DocScoreTuple current = new DocScoreTuple(docID, score);
			topList.add(current);
		}
		Collections.sort(topList, new CustomComparator());
		int outputCount = (topList.size()<config.resultNum)?topList.size():config.resultNum;
		//ArrayList<Integer> topDocs = new ArrayList<Integer>();
		FileWriter fstream = new FileWriter("out.txt");
		BufferedWriter out = new BufferedWriter(fstream);
		for(int i = 0; i < outputCount; i++){
			System.out.println(topList.get(i).docID+" "+topList.get(i).score);
			out.write(topList.get(i).docID+" "+topList.get(i).score + '\n');
		}
		out.close();
	}
}

