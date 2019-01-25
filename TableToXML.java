package dao;

import java.io.File;
import java.io.StringWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.sql.Statement;
import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;
import javax.xml.transform.OutputKeys;
import javax.xml.transform.Transformer;
import javax.xml.transform.TransformerException;
import javax.xml.transform.TransformerFactory;
import javax.xml.transform.dom.DOMSource;
import javax.xml.transform.stream.StreamResult;
 
import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.NodeList;
 
public class TableToXML {
 
	public static void main(String arg[]) {
 
 
//Table data to XML 
		Document doc = null;
		try {
			doc = TableToXML.toDocumentWithAttribute();
			// write the content into xml file
	        TransformerFactory transformerFactory = TransformerFactory.newInstance();
	        Transformer transformer = transformerFactory.newTransformer();
	        DOMSource source = new DOMSource(doc);
	        StreamResult resultat = new StreamResult(new File("monFichier.xml"));
	 
	        transformer.transform(source, resultat);
	 
	        System.out.println("Fichier sauvegardé avec succès!");
		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
 
 
	}
 
	public static Document toDocument()
			   throws ParserConfigurationException, SQLException
			{
		
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		
		try {
			Class.forName("com.mysql.jdbc.Driver");
			con = DriverManager.getConnection(
					"jdbc:mysql://localhost:3306/planning_maker", "root", "");
		} catch (Exception e) {
			System.out.println(e);
			System.exit(0);
		}

		pstmt = con
				.prepareStatement("Select * FROM agentadmin");

		rs = pstmt.executeQuery();
		
		
		
			   DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
			   DocumentBuilder builder        = factory.newDocumentBuilder();
			   Document doc                   = builder.newDocument();

			   Element results = doc.createElement("Results");
			   doc.appendChild(results);

			   ResultSetMetaData rsmd = rs.getMetaData();
			   int colCount           = rsmd.getColumnCount();

			   while (rs.next())
			   {
			      Element row = doc.createElement("Row");
			      results.appendChild(row);

			      for (int i = 1; i <= colCount; i++)
			      {
			         String columnName = rsmd.getColumnName(i);
			         Object value      = rs.getObject(i);

			         Element node      = doc.createElement(columnName);
			         node.appendChild(doc.createTextNode(value.toString()));
			         row.appendChild(node);
			      }
			   }
			   return doc;
			}
	
//*****************************************************************************************************


		public static Document toDocumentWithAttribute()
			   throws ParserConfigurationException, SQLException
			{
		
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		
		try {
			Class.forName("com.mysql.jdbc.Driver");
			con = DriverManager.getConnection(
					"jdbc:mysql://localhost:3306/planning_maker", "root", "");
		} catch (Exception e) {
			System.out.println(e);
			System.exit(0);
		}

		pstmt = con
				.prepareStatement("Select * FROM agentadmin");

		rs = pstmt.executeQuery();
		
			   DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
			   DocumentBuilder builder        = factory.newDocumentBuilder();
			   Document doc                   = builder.newDocument();

			   Element results = doc.createElement("markers");
			   doc.appendChild(results);

			   ResultSetMetaData rsmd = rs.getMetaData();
			   int colCount           = rsmd.getColumnCount();

			   while (rs.next())
			   {
			      Element row = doc.createElement("Agent");
			      results.appendChild(row);

			      for (int i = 1; i <= colCount; i++)
			      {
			         String columnName = rsmd.getColumnName(i);
			         Object value      = rs.getObject(i);

			         row.setAttribute(columnName, value.toString());

			      }
			   }
			   return doc;
			}

//*****************************************************************************************************


	public static Document generateXML() throws TransformerException,
			ParserConfigurationException {
 
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		DOMSource domSource = null;
 
		DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
		DocumentBuilder builder = factory.newDocumentBuilder();
		Document doc = builder.newDocument();
		Element results = doc.createElement("Table");
		doc.appendChild(results);
 
		try {
 
			try {
				Class.forName("com.mysql.jdbc.Driver");
				con = DriverManager.getConnection(
						"jdbc:mysql://localhost:3306/planning_maker", "root", "");
			} catch (Exception e) {
				System.out.println(e);
				System.exit(0);
			}
 
			pstmt = con
					.prepareStatement("Select * FROM agentadmin");
 
			rs = pstmt.executeQuery();
 
			System.out.println("Col count pre ");
			ResultSetMetaData rsmd = rs.getMetaData();//to retrieve table name, column name, column type and column precision, etc..
			int colCount = rsmd.getColumnCount();
 
			Element tableName = doc.createElement("TableName");
			tableName.appendChild(doc.createTextNode(rsmd.getTableName(1)));
			results.appendChild(tableName);
 
			Element structure = doc.createElement("TableStructure");
			results.appendChild(structure);
 
			Element col = null;
			for (int i = 1; i <= colCount; i++) {
 
				col = doc.createElement("Column" + i);
				results.appendChild(col);
				Element columnNode = doc.createElement("ColumnName");
				columnNode
						.appendChild(doc.createTextNode(rsmd.getColumnName(i)));
				col.appendChild(columnNode);
 
				Element typeNode = doc.createElement("ColumnType");
				typeNode.appendChild(doc.createTextNode(String.valueOf((rsmd
						.getColumnTypeName(i)))));
				col.appendChild(typeNode);
 
				Element lengthNode = doc.createElement("Length");
				lengthNode.appendChild(doc.createTextNode(String.valueOf((rsmd
						.getPrecision(i)))));
				col.appendChild(lengthNode);
 
				structure.appendChild(col);
			}
 
			System.out.println("Col count = " + colCount);
 
			Element productList = doc.createElement("TableData");
			results.appendChild(productList);
 
			int l = 0;
			while (rs.next()) {
				Element row = doc.createElement("Product" + (++l));
				results.appendChild(row);
				for (int i = 1; i <= colCount; i++) {
					String columnName = rsmd.getColumnName(i);
					Object value = rs.getObject(i);
					Element node = doc.createElement(columnName);
					node.appendChild(doc.createTextNode((value != null) ? value
							.toString() : ""));
					row.appendChild(node);
				}
				productList.appendChild(row);
			}
 
			
			
			domSource = new DOMSource(doc);
			TransformerFactory tf = TransformerFactory.newInstance();
			Transformer transformer = tf.newTransformer();
			transformer.setOutputProperty(OutputKeys.OMIT_XML_DECLARATION,
					"yes");
			transformer.setOutputProperty(OutputKeys.METHOD, "xml");
			transformer.setOutputProperty(OutputKeys.ENCODING, "ISO-8859-1");
 
			StringWriter sw = new StringWriter();
			StreamResult sr = new StreamResult(sw);
			transformer.transform(domSource, sr);
			
		
 
			System.out.println("Xml document 1" + sw.toString());
 
			System.out.println("********************************");
 
		} catch (SQLException sqlExp) {
 
			System.out.println("SQLExcp:" + sqlExp.toString());
 
		} finally {
			try {
 
				if (rs != null) {
					rs.close();
					rs = null;
				}
				if (con != null) {
					con.close();
					con = null;
				}
			} catch (SQLException expSQL) {
				System.out
						.println("CourtroomDAO::loadCourtList:SQLExcp:CLOSING:"
								+ expSQL.toString());
			}
		}
 
		// return sw.toString();
 
		return doc;
 
	}}